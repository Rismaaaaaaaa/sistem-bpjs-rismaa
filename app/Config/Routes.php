<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Auth::login');
$routes->get('/register', 'Auth::register');
$routes->post('/register', 'Auth::store');
$routes->post('/login', 'Auth::auth');
$routes->get('/logout', 'Auth::logout');




// dashboard
$routes->get('/admin/dashboard', 'Admin::index', ['filter' => 'auth']);
$routes->get('/superadmin/dashboard', 'SuperAdmin::index', ['filter' => 'auth']);
