<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// ========================
// Auth Routes
// ========================
$routes->get('/', 'Auth::login');
$routes->get('/login', 'Auth::login');
$routes->post('/auth', 'Auth::auth');
$routes->get('/logout', 'Auth::logout');

// (optional) Register kalau dipakai
$routes->get('/register', 'Auth::register');
$routes->post('/register', 'Auth::store');

// ========================
// Dashboard (Admin & Superadmin)
// ========================
$routes->get('/dashboard', 'AdminController::dashboard'); 
// nanti di DashboardController::index() lu bisa cek role (admin/superadmin)

// ========================
// Admin & Superadmin Routes
// ========================
// Semua admin route dilindungi auth
$routes->group('admin', ['filter' => 'auth'], function($routes) {
    $routes->get('dashboard', 'AdminController::dashboard');
    $routes->get('jaminan', 'JaminanController::index');
    $routes->get('bubm', 'BubmController::index');
    $routes->get('peserta', 'BubmController::coba');

    // Tambah jaminan
    $routes->get('tambah_jaminan', 'JaminanController::create');
    $routes->post('jaminan/store', 'JaminanController::store');
    $routes->post('jaminan/update', 'JaminanController::update');
    $routes->get('jaminan/filter', 'JaminanController::filter');
    $routes->post('jaminan/delete/(:num)', 'JaminanController::delete/$1');

    // BUBM
    $routes->get('tambah_bubm', 'BubmController::create');
    $routes->post('bubm/store', 'BubmController::store');
    $routes->post('bubm/update/(:num)', 'BubmController::update/$1');
    $routes->get('bubm/filter', 'BubmController::filter');
    $routes->post('bubm/delete/(:num)', 'BubmController::delete/$1');
    $routes->post('bubm/import', 'BubmController::import_bubm');
    $routes->get('bubm/export', 'BubmController::export_bubm');

    // User
    $routes->get('tambah_user', 'TambahUserController::index');
    $routes->post('tambah_user/store', 'TambahUserController::store');
    $routes->get('list_user', 'TambahUserController::list');
    $routes->get('users/edit/(:num)', 'TambahUserController::edit/$1');
    $routes->post('users/update/(:num)', 'TambahUserController::update/$1');
    $routes->get('users/delete/(:num)', 'TambahUserController::delete/$1');

    // Settings
    $routes->get('settings', 'SettingsController::index');
    $routes->post('settings/update', 'SettingsController::update');
    
});




// Tambah User
$routes->get('admin/tambah_user', 'TambahUserController::index');
$routes->post('admin/users/store', 'TambahUserController::store');

// List User
$routes->get('admin/users', 'TambahUserController::list');

// Edit + Update User
$routes->get('admin/users/edit/(:num)', 'TambahUserController::edit/$1');
$routes->post('admin/users/update', 'TambahUserController::update');

// Delete User
$routes->get('admin/users/delete/(:num)', 'TambahUserController::delete/$1');
