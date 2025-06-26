<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CartModel;
use App\Models\OrdersModel;
use App\Models\OrdersItemsModel;
use App\Models\ProductModel;
use App\Models\UsersModel;
use App\Models\ProductReviewModel;
use App\Models\PaymentsModel;
use App\Models\ShippingsModel;
use App\Models\CustomerDetailModel;

class MarketplaceController extends BaseController
{
    protected $cartModel;
    protected $ordersModel;
    protected $ordersItemsModel;
    protected $productModel;
    protected $usersModel;
    protected $reviewsModel;
    protected $paymentsModel;
    protected $shippingModel;
    protected $customerDetailModel;

    public function __construct()
    {
        $this->cartModel = new CartModel();
        $this->ordersModel = new OrdersModel();
        $this->ordersItemsModel = new OrdersItemsModel();
        $this->productModel = new ProductModel();
        $this->usersModel = new UsersModel();
        $this->reviewsModel = new ProductReviewModel();
        $this->paymentsModel = new PaymentsModel();
        $this->shippingModel = new ShippingsModel();
        $this->customerDetailModel = new CustomerDetailModel();
    }

    public function cart($userId)
    {
        $data['cartItems'] = $this->cartModel
            ->getCartWithDetails()
            ->where('cart.id_customer', $userId)
            ->findAll();
        return view('marketplace/cart', $data);
    }

    public function orderHistory($userId)
    {
        $data['orders'] = $this->ordersModel
            ->getOrdersWithCustomer()
            ->where('orders.id_customer', $userId)
            ->orderBy('orders.order_date', 'DESC')
            ->findAll();
        return view('marketplace/order_history', $data);
    }

    public function orderItems($orderId)
    {
        $data['items'] = $this->ordersItemsModel
            ->getItemsWithProduct()
            ->where('order_items.id_order', $orderId)
            ->findAll();
        return view('marketplace/order_items', $data);
    }

    public function productList()
    {
        $data['products'] = $this->productModel
            ->select('products.*, master_categories.name AS category_name')
            ->join('master_categories', 'master_categories.id_master_category = products.id_master_category', 'left')
            ->findAll();
        return view('marketplace/product_list', $data);
    }

    public function profile($userId)
    {
        $data['profile'] = $this->customerDetailModel
            ->getCustomerProfile()
            ->where('customer_detail.id_customer', $userId)
            ->first();
        return view('marketplace/profile', $data);
    }

    public function shippingStatus($orderId)
    {
        $data['shipping'] = $this->shippingModel
            ->getShippingWithDetails()
            ->where('shippings.id_order', $orderId)
            ->first();
        return view('marketplace/shipping_status', $data);
    }

    public function productReviews($productId)
    {
        $data['reviews'] = $this->reviewsModel
            ->getFullReview()
            ->where('product_reviews.id_product', $productId)
            ->findAll();
        return view('marketplace/reviews', $data);
    }

    public function paymentStatus($orderId)
    {
        $data['payment'] = $this->paymentsModel
            ->getPaymentWithOrder()
            ->where('payments.id_order', $orderId)
            ->first();
        return view('marketplace/payment_status', $data);
    }
}
