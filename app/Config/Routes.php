<?php

use CodeIgniter\Router\RouteCollection;


$routes->get('login', 'AuthController::login');
$routes->get('register', 'AuthController::register');
$routes->get('forgot-password', 'AuthController::forgotPassword');
