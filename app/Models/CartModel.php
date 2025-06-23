<?php

namespace App\Models;

use CodeIgniter\Model;

class CartModel extends Model
{
    protected $table = 'cart';
    protected $primaryKey = 'id_cart';
    // protected $useAutoIncrement = True;
    protected $allowedFields = ['id_cart', 'id_customer', 'id_product', 'quantity', 'created_at'];

    // Dates
    protected $useTimestamps = True;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    // function detail product di keranjang
    public function getCartWithDetails()
    {
        return $this->select('cart.*, users.full_name, products.product_name, products.price')
            ->join('users', 'users.id_user = cart.id_customer')
            ->join('products', 'products.id_product = cart.id_product');
    }

}
