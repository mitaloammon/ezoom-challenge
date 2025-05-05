<?php

use CodeIgniter\Router\RouteCollection;


/**
 * @var RouteCollection $routes
 */

// Rotas da API de notificações
$routes->get('api/notifications', 'NotificationController::all');
$routes->get('api/notifications/(:num)', 'NotificationController::show/$1');
$routes->post('api/notifications/create', 'NotificationController::create');








