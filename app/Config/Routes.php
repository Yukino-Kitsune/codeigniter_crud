<?php

namespace Config;

// Create a new instance of our RouteCollection class.
use App\Models\Students;

$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'UsersController::index');
$routes->post('users/login', 'UsersController::login');
$routes->get('users/reg', 'UsersController::reg');
$routes->post('users/store', 'UsersController::store');
$routes->get('users/logout', 'UsersController::logout');

$routes->group('students', ['filter' => 'authFilter'], static function ($routes)
{
    $routes->get('/', 'StudentsController::index');
    $routes->get('create', 'StudentsController::create');
    $routes->post('store', 'StudentsController::store');
    $routes->get('edit/(:num)', 'StudentsController::edit/$1');
    $routes->post('update', 'StudentsController::update');
    $routes->get('delete/(:num)', 'StudentsController::delete/$1');
});

$routes->group('teachers', ['filter' => 'authFilter'], static function ($routes)
{
    $routes->get('/', 'TeachersController::index');
    $routes->get('create', 'TeachersController::create');
    $routes->post('store', 'TeachersController::store');
    $routes->get('edit/(:num)', 'TeachersController::edit/$1');
    $routes->post('update', 'TeachersController::update');
    $routes->get('delete/(:num)', 'TeachersController::delete/$1');
});

$routes->group('subjects', ['filter' => 'authFilter'], static function($routes)
{
    $routes->get('/', 'SubjectsController::index');
    $routes->post('update', 'SubjectsController::update');
    $routes->get('delete/(:num)', 'SubjectsController::delete/$1');
    $routes->post('store', 'SubjectsController::store');
});

$routes->group('groups', ['filter' => 'authFilter'], static function($routes)
{
    $routes->get('/', 'GroupsController::index');
    $routes->get('create', 'GroupsController::create');
    $routes->post('store', 'GroupsController::store');
    $routes->get('edit/(:num)', 'GroupsController::edit/$1');
    $routes->post('update', 'GroupsController::update');
    $routes->get('delete/(:num)', 'GroupsController::delete/$1');
});

$routes->group('grades', ['filter' => 'authFilter'], static function($routes)
{
    $routes->get('/', 'GradesController::index');
    $routes->get('create', 'GradesController::create');
    $routes->post('store', 'GradesController::store');
    $routes->get('edit/(:num)', 'GradesController::edit/$1');
    $routes->post('update', 'GradesController::update');
    $routes->get('delete/(:num)', 'GradesController::delete/$1');
});

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
