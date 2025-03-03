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
    $routes->get('/profile/(:segment)', 'ProfileController::index/$1'); // View profile by username
    $routes->get('/profile', 'ProfileController::index'); // View logged-in user's profile
    $routes->get('/follow/(:num)', 'FollowersController::follow/$1');
    $routes->get('/unfollow/(:num)', 'FollowersController::unfollow/$1');

});
