<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('dashboard', 'DashboardController::index', ['filter' => 'group:admin']);

// $routes->get('office', 'OfficeController::index');

$routes->post('offices/list', 'OfficeController::list' , ['filter' => 'group:admin']);
$routes->post('tickets/list', 'TicketController::list' , ['filter' => 'group:admin,user']);

$routes->resource('offices', ['controller' => 'OfficeController', 'filter' => 'group:admin']);
$routes->resource('tickets', ['controller' => 'TicketController', 'filter' => 'group:admin,user']);

service('auth')->routes($routes);