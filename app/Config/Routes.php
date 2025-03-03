<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// Authentication Routes
$routes->group('', function ($routes) {
    $routes->get('/login', 'Auth::login');
    $routes->post('/login', 'Auth::processLogin');
    $routes->get('/register', 'Auth::register');
    $routes->post('/register', 'Auth::processRegister');
    $routes->get('/logout', 'Auth::logout');
    $routes->get('/settings', 'Settings::index');
    $routes->post('/settings/update', 'Settings::updateProfile');
    $routes->get('/profile/(:segment)', 'ProfileController::index/$1');
    $routes->get('/profile', 'ProfileController::index');
    $routes->get('/follow/(:segment)', 'Followers::follow/$1');
    $routes->get('/unfollow/(:segment)', 'Followers::unfollow/$1');
    $routes->get('/trivias', 'TriviaController::index');
    $routes->get('/trivia/create', 'TriviaController::create');
    $routes->post('/trivia/save', 'TriviaController::save');
    $routes->get('/trivia/edit/(:num)', 'TriviaController::edit/$1');
    $routes->post('/trivia/update/(:num)', 'TriviaController::update/$1');
    $routes->get('/trivia/delete/(:num)', 'TriviaController::delete/$1');
    $routes->get('/trivia/play/(:num)', 'TriviaController::play/$1'); // Start playing trivia
    $routes->post('/trivia/submit/(:num)', 'TriviaController::submit/$1'); // Submit answers
    $routes->get('/trivia/results/(:num)', 'TriviaController::results/$1'); // Show results
    $routes->get('/leaderboard', 'LeaderboardController::index');





});
