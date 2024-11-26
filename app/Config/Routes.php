<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

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
//$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
// $routes->resource('Personas');
// $routes->post('Personas/pagination', 'Personas::pagination');// Rutas para ProductCategories
$routes->resource('ProductCategories');
$routes->post('ProductCategories/pagination', 'ProductCategories::pagination');
$routes->post('ProductCategories', 'ProductCategories::create');
$routes->put('ProductCategories/(:num)', 'ProductCategories::update/$1');
$routes->delete('ProductCategories/(:num)', 'ProductCategories::delete/$1');

// Rutas para OrderDetails
$routes->resource('OrderDetails');
$routes->post('OrderDetails/pagination', 'OrderDetails::pagination');
$routes->put('OrderDetails/(:num)', 'OrderDetails::update/$1');
$routes->delete('OrderDetails/(:num)', 'OrderDetails::delete/$1');

// Rutas para OrderStatuses
$routes->resource('OrderStatuses');
$routes->post('OrderStatuses/pagination', 'OrderStatuses::pagination');
$routes->put('OrderStatuses/(:num)', 'OrderStatuses::update/$1');
$routes->delete('OrderStatuses/(:num)', 'OrderStatuses::delete/$1');

// Rutas para Orders
$routes->resource('Orders');
$routes->post('Orders/pagination', 'Orders::pagination');
$routes->put('Orders/(:num)', 'Orders::update/$1');
$routes->delete('Orders/(:num)', 'Orders::delete/$1');

// Rutas para Products
$routes->resource('Products');
$routes->post('Products/pagination', 'Products::pagination');
$routes->put('Products/(:num)', 'Products::update/$1');
$routes->delete('Products/(:num)', 'Products::delete/$1');

// Rutas para UserStatuses
$routes->resource('UserStatuses');
$routes->post('UserStatuses/pagination', 'UserStatuses::pagination');
$routes->put('UserStatuses/(:num)', 'UserStatuses::update/$1');
$routes->delete('UserStatuses/(:num)', 'UserStatuses::delete/$1');

// Rutas para Users
$routes->resource('Users');
$routes->post('Users/pagination', 'Users::pagination');
$routes->put('Users/(:num)', 'Users::update/$1');
$routes->delete('Users/(:num)', 'Users::delete/$1');


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
