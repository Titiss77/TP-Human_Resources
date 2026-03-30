<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('employees/rowcount',    'Employees::rowCount');
$routes->resource("employees");