<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\CartModel;
use App\Models\ProductModel;

class CartController extends Controller
{
    protected $cartModel;
    protected $productModel;
    protected $session;

    public function __construct()
    {
        $this->cartModel    = new CartModel();
        $this->productModel = new ProductModel();
        $this->session      = session();
    }

    public function index()
    {
        // Pastikan path view sesuai dengan struktur folder di aplikasi Anda
        $session = session();
        if (!$session->get('is_logged_in')) {
            return redirect()->to('/customerAuth/login');
        }
        return view('cart/cart');
    }

    /* Menambahkan produk ke dalam keranjang */
    public function addToCart($productId)
    {
        $session = session();
        if (!$session->get('is_logged_in')) {
            return redirect()->to('/customerAuth/login');
        }

        // Ambil data produk berdasarkan productId
        $product = $this->productModel->find($productId);

        if (!$product) {
            return redirect()->back()->with('error', 'Produk tidak ditemukan');
        }

        // Dapatkan kuantitas dari input, default 1 jika tidak diset
        $quantity = $this->request->getVar('quantity') ?: 1;

        // 'CART' (4 karakter) + 8 karakter acak
        $id_cart = 'CART' . strtoupper(substr(md5(uniqid()), 0, 8));
        $cartData = [
            'id_cart'     => $id_cart,
            'id_customer' => $this->session->get('id_customer'),
            'id_product'  => $productId,
            'quantity'    => $quantity,
            'created_at'  => date('Y-m-d H:i:s')
        ];

        $this->cartModel->addToCart($cartData);

        return redirect()->to('/cart')->with('success', 'Produk berhasil ditambahkan ke keranjang');
    }

    /* Menampilkan halaman keranjang belanja */
    public function viewCart()
    {
        $session = session();
        if (!$session->get('is_logged_in')) {
            return redirect()->to('/customerAuth/login');
        }

        $customerId = $this->session->get('id_customer');
        $cartItems  = $this->cartModel->getCartByCustomerId($customerId);

        return view('cart/cart', [
            'isLoggedIn' => true,
            'cartItems'  => $cartItems,
        ]);
    }

    /* Mengupdate kuantitas produk dalam cart */
    public function updateCart($cartId)
    {
        $session = session();
        if (!$session->get('is_logged_in')) {
            return redirect()->to('/customerAuth/login');
        }


        $quantity = $this->request->getVar('quantity');

        if ($quantity <= 0) {
            return redirect()->back()->with('error', 'Kuantitas harus lebih besar dari 0');
        }

        $this->cartModel->updateQuantity($cartId, $quantity);

        return redirect()->to('/cart')->with('success', 'Kuantitas diperbarui');
    }

    public function update_quantity()
    {
        $session = session();
        if (!$session->get('is_logged_in')) {
            return $this->response->setStatusCode(401)->setJSON(['error' => 'Anda harus login terlebih dahulu.']);
        }

        // Mengambil input JSON
        $json = $this->request->getJSON();
        if (!$json || !isset($json->id_cart) || !isset($json->quantity)) {
            return $this->response->setStatusCode(400)->setJSON(['error' => 'Input tidak valid.']);
        }

        $id_cart  = $json->id_cart;
        $quantity = (int)$json->quantity;

        if ($quantity <= 0) {
            return $this->response->setStatusCode(400)->setJSON(['error' => 'Kuantitas harus lebih besar dari 0.']);
        }

        // Memperbarui kuantitas di model
        $this->cartModel->updateQuantity($id_cart, $quantity);

        return $this->response->setJSON(['success' => true]);
    }

    /* Menghapus item dari keranjang */
    public function removeFromCart($cartId)
    {
        $session = session();
        if (!$session->get('is_logged_in')) {
            return redirect()->to('/customerAuth/login');
        }


        $this->cartModel->removeFromCart($cartId);

        return redirect()->to('/cart')->with('success', 'Produk dihapus dari keranjang');
    }

    /* Menghapus semua item dari keranjang */
    public function clearCart()
    {
        $session = session();
        if (!$session->get('is_logged_in')) {
            return redirect()->to('/customerAuth/login');
        }


        $customerId = $this->session->get('id_customer');
        $this->cartModel->clearCartByCustomerId($customerId);

        return redirect()->to('/cart')->with('success', 'Keranjang telah dikosongkan');
    }
}
