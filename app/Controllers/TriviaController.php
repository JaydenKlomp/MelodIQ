<?php

namespace App\Controllers;

use App\Models\TriviaModel;
use CodeIgniter\Controller;

class TriviaController extends Controller
{
    public function index()
    {
        $triviaModel = new TriviaModel();
        $db = \Config\Database::connect();
        $userId = session()->get('id');

        // Get search query, category, and difficulty filters
        $search = $this->request->getGet('search');
        $category = $this->request->getGet('category');
        $difficulty = $this->request->getGet('difficulty');

        // Fetch filtered trivia
        $trivias = $triviaModel->filterTrivia($search, $category, $difficulty);

        // Fetch completed trivia for the logged-in user
        $completedTrivias = [];
        if ($userId) {
            $completedTrivias = $db->table('user_trivia_progress')
                ->select('trivia_id')
                ->where('user_id', $userId)
                ->groupBy('trivia_id')
                ->get()
                ->getResultArray();

            $completedTrivias = array_column($completedTrivias, 'trivia_id');
        }

        return view('trivias', [
            'trivias' => $trivias,
            'search' => $search,
            'category' => $category,
            'difficulty' => $difficulty,
            'completedTrivias' => $completedTrivias // ✅ Pass completed trivias
        ]);
    }


    public function create()
    {
        if (!session()->get('is_admin')) {
            return redirect()->to('/')->with('error', 'You do not have permission to access this page.');
        }

        return view('trivia/create'); // ✅ Ensure correct path
    }

    public function save()
    {
        if (!session()->get('is_admin')) {
            return redirect()->to('/')->with('error', 'You do not have permission to access this page.');
        }

        $triviaModel = new TriviaModel();
        $db = \Config\Database::connect();

        $triviaData = [
            'title' => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
            'category' => $this->request->getPost('category'),
            'difficulty' => $this->request->getPost('difficulty'),
            'time_limit' => $this->request->getPost('time_limit'),
            'public' => $this->request->getPost('public'),
            'created_by' => session()->get('id'),
            'created_at' => date('Y-m-d H:i:s')
        ];

        // ✅ Insert Trivia and get its ID
        if (!$triviaModel->insert($triviaData)) {
            print_r($triviaModel->errors());
            exit();
        }
        $triviaId = $triviaModel->insertID();

        // ✅ Insert Questions
        $questions = $this->request->getPost('questions') ?? [];

        foreach ($questions as $q) {
            $questionData = [
                'trivia_id' => $triviaId,
                'question_text' => $q['text'],
                'video_url' => !empty($q['video']) ? $q['video'] : null,
                'audio_url' => !empty($q['audio']) ? $q['audio'] : null
            ];

            $db->table('questions')->insert($questionData);
            $questionId = $db->insertID();

            // ✅ Insert Answers
            if (!empty($q['answers'])) {
                foreach ($q['answers'] as $a) {
                    $answerData = [
                        'question_id' => $questionId,
                        'answer_text' => $a['text'],
                        'is_correct' => isset($a['correct']) ? 1 : 0
                    ];
                    $db->table('answers')->insert($answerData);
                }
            }
        }

        return redirect()->to('/trivia/edit/' . $triviaId)->with('success', 'Trivia created successfully!');
    }

    public function edit($id)
    {
        if (!session()->get('is_admin')) {
            return redirect()->to('/')->with('error', 'You do not have permission to edit trivia.');
        }

        $triviaModel = new TriviaModel();
        $db = \Config\Database::connect();

        // Fetch Trivia Details
        $trivia = $triviaModel->find($id);
        if (!$trivia) {
            return redirect()->to('/trivias')->with('error', 'Trivia not found.');
        }

        // Fetch Questions
        $questions = $db->table('questions')->where('trivia_id', $id)->get()->getResultArray();
        foreach ($questions as &$q) {
            $q['answers'] = $db->table('answers')->where('question_id', $q['id'])->get()->getResultArray();
        }

        return view('trivia/edit', [
            'trivia' => $trivia,
            'questions' => $questions
        ]);
    }

    public function update($id)
    {
        if (!session()->get('is_admin')) {
            return redirect()->to('/')->with('error', 'You do not have permission to edit trivia.');
        }

        $triviaModel = new TriviaModel();
        $db = \Config\Database::connect();

        // Update Trivia
        $triviaData = [
            'title' => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
        ];
        $triviaModel->update($id, $triviaData);

        // Update Questions
        $questions = $this->request->getPost('questions');
        foreach ($questions as $qId => $qData) {
            $db->table('questions')->where('id', $qId)->update([
                'question_text' => $qData['text'],
                'video_url' => !empty($qData['video']) ? $qData['video'] : null,
                'audio_url' => !empty($qData['audio']) ? $qData['audio'] : null
            ]);

            // Update Answers
            if (!empty($qData['answers'])) {
                foreach ($qData['answers'] as $aId => $aData) {
                    $db->table('answers')->where('id', $aId)->update([
                        'answer_text' => $aData['text'],
                        'is_correct' => isset($aData['correct']) ? 1 : 0
                    ]);
                }
            }
        }

        return redirect()->to('/trivia/edit/' . $id)->with('success', 'Trivia updated successfully!');
    }

    public function delete($id)
    {
        if (!session()->get('is_admin')) {
            return redirect()->to('/')->with('error', 'You do not have permission to delete trivia.');
        }

        $db = \Config\Database::connect();

        // Check if the trivia exists
        $trivia = $db->table('trivia')->where('id', $id)->get()->getRowArray();
        if (!$trivia) {
            return redirect()->to('/trivias')->with('error', 'Trivia not found.');
        }

        // Delete associated answers first
        $db->table('answers')->whereIn('question_id', function($builder) use ($id) {
            return $builder->select('id')->from('questions')->where('trivia_id', $id);
        })->delete();

        // Delete associated questions
        $db->table('questions')->where('trivia_id', $id)->delete();

        // Delete trivia
        $db->table('trivia')->where('id', $id)->delete();

        return redirect()->to('/trivias')->with('success', 'Trivia deleted successfully!');
    }

    public function play($id)
    {
        $db = \Config\Database::connect();

        // Fetch Trivia
        $trivia = $db->table('trivia')->where('id', $id)->get()->getRowArray();
        if (!$trivia) {
            return redirect()->to('/trivias')->with('error', 'Trivia not found.');
        }

        // Fetch Questions
        $questions = $db->table('questions')->where('trivia_id', $id)->get()->getResultArray();
        foreach ($questions as &$q) {
            $q['answers'] = $db->table('answers')->where('question_id', $q['id'])->get()->getResultArray();

            shuffle($q['answers']);
        }

        return view('trivia/play', [
            'trivia' => $trivia,
            'questions' => $questions
        ]);
    }

    public function submit($id)
    {
        $db = \Config\Database::connect();
        $userId = session()->get('id');

        if (!$userId) {
            return redirect()->to('/login')->with('error', 'You need to be logged in to play.');
        }

        // ✅ Fetch only the correct answers for this trivia
        $correctAnswers = [];
        $query = $db->table('answers')
            ->select('question_id, id')
            ->whereIn('question_id', function ($builder) use ($id) {
                return $builder->select('id')->from('questions')->where('trivia_id', $id);
            })
            ->where('is_correct', 1)
            ->get()
            ->getResultArray();

        foreach ($query as $ans) {
            $correctAnswers[$ans['question_id']] = $ans['id'];
        }

        // ✅ Calculate score & track correct/incorrect answers
        $userAnswers = $this->request->getPost('answers');
        $score = 0;
        $correctCount = 0;
        $incorrectCount = 0;
        $totalQuestions = count($correctAnswers);

        foreach ($userAnswers as $questionId => $answerId) {
            if (isset($correctAnswers[$questionId]) && $correctAnswers[$questionId] == $answerId) {
                $score += 10;
                $correctCount++;
            } else {
                $incorrectCount++;
            }
        }

        // ✅ Calculate answer accuracy properly
        $accuracy = ($totalQuestions > 0) ? round(($correctCount / $totalQuestions) * 100, 2) : 0;

        // ✅ Get time spent from the frontend form
        $timeSpent = (int) $this->request->getPost('time_spent');

        // ✅ Save progress for this trivia attempt
        $db->table('user_trivia_progress')->insert([
            'user_id' => $userId,
            'trivia_id' => $id,
            'score' => $score,
            'time_taken' => $timeSpent,
            'completed_at' => date('Y-m-d H:i:s')
        ]);

        // ✅ Ensure `incorrect_answers` column exists in the `users` table
        $db->table('users')->where('id', $userId)->set([
            'total_points' => 'total_points + ' . $score,
            'trivia_played' => 'trivia_played + 1',
            'correct_answers' => 'correct_answers + ' . $correctCount,
            'incorrect_answers' => 'incorrect_answers + ' . $incorrectCount,
            'time_spent' => 'time_spent + ' . $timeSpent
        ], '', false)->update();

        return redirect()->to('/trivia/results/' . $id)->with('success', 'Trivia completed! Check your results.');
    }


    public function results($id)
    {
        $db = \Config\Database::connect();
        $userId = session()->get('id');

        if (!$userId) {
            return redirect()->to('/login')->with('error', 'You need to be logged in to view results.');
        }

        // Fetch trivia details
        $trivia = $db->table('trivia')->where('id', $id)->get()->getRowArray();
        if (!$trivia) {
            return redirect()->to('/trivias')->with('error', 'Trivia not found.');
        }

        // Fetch the user's score for this trivia
        $userProgress = $db->table('user_trivia_progress')
            ->where(['user_id' => $userId, 'trivia_id' => $id])
            ->orderBy('completed_at', 'DESC')
            ->get()
            ->getRowArray();

        if (!$userProgress) {
            return redirect()->to('/trivias')->with('error', 'No recorded score for this trivia.');
        }

        return view('trivia/results', [
            'trivia' => $trivia,
            'score' => $userProgress['score'],
            'correctCount' => round($userProgress['score'] / 10) // Assuming 10 points per correct answer
        ]);
    }



}
