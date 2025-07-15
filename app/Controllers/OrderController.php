<?php
// File: app/Controllers/OrderController.php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\OrdersModel;
use App\Models\ProductModel;

class OrderController extends Controller
{
    protected $orderModel;
    protected $orderItemModel;
    protected $productModel;
    protected $session;

    public function __construct()
    {
        $this->orderModel      = new OrdersModel();
        $this->productModel    = new ProductModel();
        $this->session         = session();
    }

    public function detail($orderId)
    {
        if (!$this->session->get('is_logged_in')) {
            return redirect()->to('/customerAuth/login');
        }

        // Ambil data order berdasarkan ID
        $order = $this->orderModel->find($orderId);
        if (!$order) {
            return redirect()->to('/')->with('error', 'Order tidak ditemukan.');
        }

        // Ambil data order item
        // Pastikan method getOrderItemsByOrderId() telah didefinisikan di 
        $orderItems = $this->orderItemModel->getOrderItemsByOrderId($orderId);
        if (!empty($orderItems)) {
            foreach ($orderItems as &$item) {
                $product = $this->productModel->find($item['id_product']);
                $item['product_name']  = $product ? $product['product_name'] : 'Produk tidak ditemukan';
                // Pastikan path gambar sesuai dengan struktur folder Anda
                $item['product_image'] = $product ? base_url('uploads/img/products/' . explode(',', $product['image'])[0]) : '';
            }
        }

        return view('order_detail', [
            'order'      => $order,
            'orderItems' => $orderItems
        ]);
    }
}
