<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Auth routes
$routes->get('/', 'Auth::login');
$routes->post('/auth', 'Auth::auth');

$routes->get('/login', 'Auth::login');
$routes->get('/logout', 'Auth::logout');

// (optional) register kalau dipakai
$routes->get('/register', 'Auth::register');
$routes->post('/register', 'Auth::store');

// Dashboard routes
$routes->get('/admin/dashboard', 'AdminController::dashboard');
$routes->get('/admin/jaminan', 'JaminanController::index');
$routes->get('/admin/bubm', 'BubmController::index');

$routes->get('/super/dashboard', 'Super::dashboard');