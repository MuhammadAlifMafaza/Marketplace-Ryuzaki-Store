<?php
// File: app/Controllers/CheckoutController.php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\OrderModel;
use App\Models\OrderItemModel;
use App\Models\CartModel;
use App\Models\ProductModel;

class CheckoutController extends Controller
{
    protected $orderModel;
    protected $orderItemModel;
    protected $cartModel;
    protected $productModel;
    protected $session;

    public function __construct()
    {
        $this->orderModel      = new OrderModel();
        $this->orderItemModel  = new OrderItemModel();
        $this->cartModel       = new CartModel();
        $this->productModel    = new ProductModel();
        $this->session         = session();
    }

    // Tampilkan halaman checkout
    public function index()
    {
        if (!$this->session->get('is_logged_in')) {
            return redirect()->to('/customerAuth/login');
        }

        // Gunakan nama session yang konsisten, misalnya 'id_customer'
        $userId    = $this->session->get('id_customer');
        $cartItems = $this->cartModel->getCartByCustomerId($userId);

        return view('checkout/checkout', [
            'cartItems' => $cartItems
        ]);
    }

    // Proses checkout
    public function processCheckout()
    {
        if (!$this->session->get('is_logged_in')) {
            return redirect()->to('/customerAuth/login');
        }

        $userId = $this->session->get('id_customer'); // Pastikan konsisten dengan saat login
        $destinationAddress = $this->request->getPost('destination_address');

        if (empty($destinationAddress)) {
            return redirect()->back()->with('error', 'Alamat tujuan harus diisi.');
        }

        // Ambil semua item keranjang milik user
        $cartItems = $this->cartModel->getCartByCustomerId($userId);
        if (empty($cartItems)) {
            return redirect()->back()->with('error', 'Keranjang Anda kosong.');
        }

        // Generate ID Order (misalnya: ORD + 9 karakter acak sehingga total 12 karakter)
        $orderId = 'ORD' . strtoupper(substr(md5(uniqid()), 0, 9));

        // Siapkan data order
        $orderData = [
            'id_order'            => $orderId,
            'id_customer'         => $userId,
            'order_date'          => date('Y-m-d H:i:s'),
            'destination_address' => $destinationAddress,
            'status'              => 'pending',
            'total_amount'        => 0  // akan dihitung di bawah
        ];

        // Insert order terlebih dahulu
        $this->orderModel->insert($orderData);

        $totalAmount = 0;
        // Untuk setiap item di keranjang, buat record order_item
        foreach ($cartItems as $item) {
            $product = $this->productModel->find($item['id_product']);
            if (!$product) continue;

            // Generate ID order item (misalnya: OIT + 9 karakter acak sehingga total 12 karakter)
            $orderItemId = 'OIT' . strtoupper(substr(md5(uniqid()), 0, 9));

            $quantity = $item['quantity'];
            $price    = $product['price'];
            $subtotal = $price * $quantity;
            $totalAmount += $subtotal;

            $orderItemData = [
                'id_order_item' => $orderItemId,
                'id_order'      => $orderId,
                'id_product'    => $item['id_product'],
                'quantity'      => $quantity,
                'price'         => $price
            ];

            $this->orderItemModel->insert($orderItemData);
        }

        // Update total_amount di order
        $this->orderModel->update($orderId, ['total_amount' => $totalAmount]);

        // Bersihkan keranjang untuk user tersebut
        $this->cartModel->clearCartByCustomerId($userId);

        // Arahkan ke halaman detail transaksi dengan mengirimkan ID order
        return redirect()->to('/order/detail/' . $orderId)->with('success', 'Order berhasil dibuat.');
    }
}
