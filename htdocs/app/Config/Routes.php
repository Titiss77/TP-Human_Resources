<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');
$routes->get('employees/rowcount', 'Employees::rowCount');
$routes->get('employees/name/(:any)', 'Employees::findByName/$1');
$routes->resource('employees');
