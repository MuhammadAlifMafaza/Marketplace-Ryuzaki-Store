<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'CustomerController::index');

// routes untuk customer
$routes->group('customer', function ($routes) {
    $routes->get('', '');
});

// routes untuk admin
$routes->group('admin', function ($routes) {
    $routes->get('login', 'AuthAdminController::login');
    $routes->post('loginProcess', 'AuthAdminController::loginProcess');
    $routes->get('forgot-password', 'AuthAdminController::forgotPassword');
    $routes->post('forgot-password', '');
    $routes->get('logout', 'AuthAdminController::logout');

    $routes->get('dashboard', 'AdminController::dashboard');

    $routes->get('list-product', 'AdminController::listProduct');
    $routes->get('create-product', 'AdminController::addProduct');
    $routes->get('edit-product', 'AdminController::editProduct');
    $routes->get('detail-product', 'AdminController::detailProduct');
    $routes->post('delete-product', 'AdminController::deleteProduct');

    $routes->get('list-category', '');
    $routes->get('edit-category', '');
    $routes->get('detail-category', '');
    $routes->get('delete-category', '');
});

// routes untuk owner
$routes->group('owner', function ($routes) {
    $routes->get('/', '');
});

// routes untuk Courir
$routes->group('kurir', function ($routes) {
    $routes->get('', '');
});
