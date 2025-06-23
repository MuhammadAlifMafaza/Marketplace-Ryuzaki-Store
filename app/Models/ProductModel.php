<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'id_product';
    protected $allowedFields = ['id_product', 'product_name', 'id_master_category', 'description', 'image', 'price', 'stock_quantity', 'average_rating', 'created_at', 'updated_at'];

    // Dates
    protected $useTimestamps = True;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';


    // function search product
    public function searchProducts($keyword = null, $category = null)
    {
        $builder = $this->table($this->table);

        if (!empty($keyword)) {
            $builder->like('product_name', $keyword);
        }

        if (!empty($category) && $category !== 'all') {
            $builder->where('category', $category);
        }

        return $builder->get()->getResultArray();
    }

    // Function to fetch all products
    public function getAllProducts()
    {
        return $this->findAll();
    }

    // Function to fetch product by ID
    public function getProductById($id_product)
    {
        return $this->find($id_product);
    }

    // Function to insert a new product
    public function createProduct($data)
    {
        return $this->insert($data);
    }

    // Function to update product by ID
    public function updateProduct($id_product, $data)
    {
        return $this->update($id_product, $data);
    }

    // Function untuk delete product by ID
    public function deleteProduct($id)
    {
        // melakukan cek data apabila data ada
        $product = $this->find($id);
        if (!$product) {
            return false; // Product tidak ditemukan
        }

        // Menghapus data product
        return $this->delete($id);
    }
}
