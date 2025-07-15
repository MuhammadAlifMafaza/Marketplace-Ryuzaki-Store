<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'CustomerController::index');

// ======================== AUTH ========================
$routes->group('/', function ($routes) {
    $routes->get('login', 'AuthController::login');
    $routes->post('login', 'AuthController::loginProcess');
    $routes->get('register', 'AuthController::register');
    $routes->post('register', 'AuthController::registerProcess');
    $routes->get('logout', 'AuthController::logout');
});

// ======================== CUSTOMER ========================
$routes->group('customer', function ($routes) {
    $routes->get('cart', 'MarketplaceController::cart');
    $routes->get('orders', 'MarketplaceController::orderHistory');
    $routes->get('orders/(:segment)/items', 'MarketplaceController::orderItems/$1');
    $routes->get('profile', 'MarketplaceController::profile');
    $routes->get('shipping/(:segment)', 'MarketplaceController::shippingStatus/$1');
    $routes->get('payment/(:segment)', 'MarketplaceController::paymentStatus/$1');
    $routes->get('reviews/(:segment)', 'MarketplaceController::productReviews/$1');
});

// ======================== SELLER(?) ========================
$routes->group('seller', function ($routes) {
    $routes->get('dashboard', 'SellerController::dashboard');
    // tambah routes seller lainnya di sini
});

// ======================== ROUTES GROUP KARYAWAN ========================
$routes->group('karyawan', function ($routes) {
    // ======================== AUTH KARYAWAN ========================
    $routes->get('login', 'AuthKaryawanController::login');
    $routes->post('loginProcess', 'AuthKaryawanController::loginProcess');
    $routes->get('forgot-password', 'AuthKaryawanController::forgotPassword');
    $routes->post('forgot-password', 'AuthKaryawanController::forgotPasswordProcess');
    $routes->get('reset-password/(:any)', 'AuthKaryawanController::resetPassword/$1');
    $routes->post('reset-password', 'AuthKaryawanController::resetPasswordProcess');
    $routes->get('logout', 'AuthKaryawanController::logout');

    $routes->group('admin', ['filter' => 'karyawan:admin'], function ($routes) {

        $routes->get('dashboard', 'AdminController::dashboard');

        // Produk
        $routes->group('products', function ($routes) {
            $routes->get('/', 'ProductController::indexProduct');
            $routes->get('create', 'ProductController::addProduct');
            $routes->post('store-product', 'ProductController::storeProduct');
            $routes->get('edit/(:any)', 'ProductController::editProduct/$1');
            $routes->post('update-product/(:any)', 'ProductController::updateProduct/$1');
            $routes->get('detail/(:any)', 'ProductController::detailProduct/$1');
            $routes->post('delete/(:any)', 'ProductController::deleteProduct/$1');
        });

        // Kategori Master & Sub
        $routes->group('categories', function ($routes) {
            $routes->get('/', 'CategoriesController::index');
            $routes->get('create', 'CategoriesController::createMaster');
            $routes->post('store', 'CategoriesController::storeMaster');
            $routes->get('edit/(:any)', 'CategoriesController::editMaster/$1');
            $routes->post('update/(:any)', 'CategoriesController::updateMaster/$1');
            $routes->get('delete/(:any)', 'CategoriesController::deleteMaster/$1');

            // Sub
            $routes->group('subcategories', function ($routes) {
                $routes->get('(:any)', 'CategoriesController::subcategories/$1');
                $routes->get('create/(:any)', 'CategoriesController::createSub/$1');
                $routes->post('store', 'CategoriesController::storeSub');
                $routes->get('edit/(:any)', 'CategoriesController::editSub/$1');
                $routes->post('update/(:any)', 'CategoriesController::updateSub/$1');
                $routes->get('delete/(:any)', 'CategoriesController::deleteSub/$1');
            });
        });

        // Orders
        $routes->group('orders', function ($routes) {
            $routes->get('/', 'OrdersController::index');
            $routes->get('detail/(:any)', 'OrdersController::detail/$1');
            $routes->post('update-status', 'OrdersController::updateStatus');
        });
    });

    /* ======================== OWNER ======================== */
    $routes->group('owner', ['filter' => 'karyawan:owner'], function ($routes) {
        $routes->get('dashboard', 'OwnerController::dashboard');
        // Tambah fitur lainnya untuk owner di sini
    });

    /* ======================== KURIR ======================== */
    $routes->group('kurir', ['filter' => 'karyawan:kurir'], function ($routes) {
        $routes->get('dashboard', 'CourierController::dashboard');
        // Tambah fitur lainnya untuk kurir di sini
    });
});
