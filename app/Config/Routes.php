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

$routes->group('owner', function ($routes) {
    $routes->get('/', '');
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

    $routes->get('categories', 'CategoriesController::index');
    $routes->get('categories/create', 'CategoriesController::createMaster');
    $routes->post('categories/store', 'CategoriesController::storeMaster');
    $routes->get('categories/edit/(:num)', 'CategoriesController::editMaster/$1');
    $routes->post('categories/update/(:num)', 'CategoriesController::updateMaster/$1');
    $routes->get('categories/delete/(:num)', 'CategoriesController::deleteMaster/$1');

    $routes->get('categories/subcategories/(:num)', 'CategoriesController::subcategories/$1');
    $routes->get('categories/subcategories/create/(:num)', 'CategoriesController::createSub/$1');
    $routes->post('categories/subcategories/store', 'CategoriesController::storeSub');
    $routes->get('categories/subcategories/edit/(:num)', 'CategoriesController::editSub/$1');
    $routes->post('categories/subcategories/update/(:num)', 'CategoriesController::updateSub/$1');
    $routes->get('categories/subcategories/delete/(:num)', 'CategoriesController::deleteSub/$1');
});

// routes untuk owner
$routes->group('owner', function ($routes) {
    $routes->get('/', '');
});

// routes untuk Courir
$routes->group('kurir', function ($routes) {
    $routes->get('', '');
});
