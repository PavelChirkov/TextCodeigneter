<?php

namespace Config;

// Create a new instance of our RouteCollection class.
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
$routes->get('/', 'Home::index');

/**note***/
$routes->get('notes', 'NoteController::index');
$routes->get('notes/new', 'NoteController::new');
$routes->post('notes', 'NoteController::create');
$routes->get('notes/(:num)', 'NoteController::show/$1');
$routes->get('notes/edit/(:num)', 'NoteController::edit/$1');
$routes->put('notes/(:num)', 'NoteController::update/$1');
$routes->delete('notes/(:num)', 'NoteController::delete/$1');

/**user**/
$routes->get('user', 'UserController::index');
$routes->get('user/new', 'UserController::new');
$routes->post('user', 'UserController::create');
$routes->get('user/(:num)', 'UserController::show/$1');
$routes->get('user/edit/(:num)', 'UserController::edit/$1');
$routes->put('user/(:num)', 'UserController::update/$1');
$routes->delete('user/(:num)', 'UserController::delete/$1');

/**login**/
$routes->get('login', 'LoginController::index');
$routes->post('login/on', 'LoginController::log_on'); 
$routes->get('login/logout', 'LoginController::logout');


/**cabinet**/
$routes->get('cabinet', 'CabinetController::index');
$routes->get('cabinet/note/add', 'CabinetController::noteAdd');
$routes->get('cabinet/note/add/(:num)', 'CabinetController::noteAdd/$1');
$routes->post('cabinet/note/save', 'CabinetController::noteSave');
$routes->get('cabinet/note/view/(:num)', 'CabinetController::noteView/$1');
$routes->post('cabinet/note/update/(:num)', 'CabinetController::noteUpdate/$1');
$routes->get('cabinet/note/edit/(:num)', 'CabinetController::noteEditFull/$1');
$routes->post('cabinet/tagging/save/(:num)', 'CabinetController::tagSave/$1');
$routes->get('cabinet/map_node/(:num)', 'CabinetController::mapNote/$1');
$routes->post('cabinet/note/loadimage/(:num)', 'CabinetController::imageNote/$1');
$routes->get('cabinet/note/deleteimage/(:num)', 'CabinetController::imageDelete/$1'); 

/**user*/
$routes->get('cabinet/user', 'CabinetController::userProfile');
$routes->post('cabinet/user/update', 'CabinetController::userProfileUpdate');
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

