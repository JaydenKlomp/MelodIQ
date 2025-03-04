<?php

namespace App\Models;

use CodeIgniter\Model;

class TriviaModel extends Model
{
    protected $table = 'trivia';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'title',
        'description',
        'category',
        'difficulty',
        'time_limit',
        'public',
        'created_by',
        'created_at'
    ];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = null;

    public function filterTrivia($search = null, $category = null, $difficulty = null)
    {
        if ($search) {
            $this->like('title', $search);
        }

        if ($category) {
            $this->where('category', $category);
        }

        if ($difficulty) {
            $this->where('difficulty', $difficulty);
        }

        return $this->orderBy('created_at', 'DESC')->findAll();
    }
}
