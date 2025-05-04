<?php

use CodeIgniter\Router\RouteCollection;


/**
 * @var RouteCollection $routes
 */

$routes->post('api/notifications/create', 'NotificationController::create');            
$routes->get('api/notifications/(:num)', 'NotificationController::list/$1'); 
$routes->get('api/notifications', 'NotificationController::all');








