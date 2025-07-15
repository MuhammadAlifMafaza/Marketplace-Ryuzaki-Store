<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\ProductModel;
use App\Models\MasterCategoriesModel;
use App\Models\SubCategoriesModel;
use App\Models\ProductSubCategoriesModel;

class ProductController extends Controller
{
    protected $productModel;
    protected $masterCategoriesModel;
    protected $subCategoriesModel;
    protected $productSubCategoriesModel;

    public function __construct()
    {
        $this->productModel = new ProductModel();
        $this->masterCategoriesModel = new MasterCategoriesModel();
        $this->subCategoriesModel = new SubCategoriesModel();
        $this->productSubCategoriesModel = new ProductSubCategoriesModel();
    }

    public function indexProduct()
    {
        $data['products'] = $this->productModel
            ->builder() // langsung ke query builder
            ->select('products.*, master_categories.name_category')
            ->join('master_categories', 'products.id_master_category = master_categories.id_master_category', 'left')
            ->get()
            ->getResultArray(); // ambil hasil array, bukan objek

        return view('employers/admin/products/index.php', $data);
    }


    public function addProduct()
    {
        $data['masterCategories'] = $this->masterCategoriesModel->findAll();
        return view('employers/admin/products/create', $data);
    }

    private function generateProductID($productName)
    {
        $slug = url_title($productName, '-', true);
        $baseId = $slug;

        // Cek jika slug dasar sudah ada
        if (!$this->productModel->find($baseId)) {
            return $baseId;
        }

        $index = 1;
        do {
            $newId = $baseId . '-' . str_pad($index, 3, '0', STR_PAD_LEFT);
            $exists = $this->productModel->find($newId);
            $index++;
        } while ($exists);

        return $newId;
    }

    public function storeProduct()
    {
        helper(['form']);

        $validationRules = [
            'product_name'        => 'required|min_length[3]|max_length[255]',
            'id_master_category'  => 'required',
            'price'               => 'required|numeric',
            'stock_quantity'      => 'required|integer'
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('error', implode(', ', $this->validator->getErrors()));
        }

        // 1. Generate Product ID
        $productName = $this->request->getPost('product_name');
        $productID   = $this->generateProductID($productName);
        if (!$productID) {
            return redirect()->back()->withInput()->with('error', 'Gagal membuat ID produk. Silakan coba lagi.');
        }

        // 2. Handle File Uploads (standar method, bukan base64)
        $uploadedFiles = $this->request->getFiles();
        $imagePaths = [];

        if (!isset($uploadedFiles['images']) || !is_array($uploadedFiles['images']) || count($uploadedFiles['images']) === 0) {
            return redirect()->back()->withInput()->with('error', 'Minimal 1 gambar harus diunggah.');
        }

        $uploadPath = FCPATH . 'uploads/product/';
        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0777, true);
        }

        foreach ($uploadedFiles['images'] as $file) {
            if ($file->isValid() && !$file->hasMoved() && $file->getName() !== '') {
                $mime = $file->getClientMimeType();
                if (!in_array($mime, ['image/jpeg', 'image/png', 'image/jpg'])) {
                    return redirect()->back()->withInput()->with('error', 'Hanya file JPG dan PNG yang diizinkan.');
                }

                $newName = $file->getRandomName();
                $file->move($uploadPath, $newName);
                $imagePaths[] = 'uploads/product/' . $newName;
            }
        }

        if (empty($imagePaths)) {
            return redirect()->back()->withInput()->with('error', 'Gagal mengunggah gambar. Periksa file gambar Anda.');
        }

        // 3. Simpan ke DB
        $data = [
            'id_product'         => $productID,
            'product_name'       => $productName,
            'id_master_category' => $this->request->getPost('id_master_category'),
            'description'        => $this->request->getPost('description'),
            'image'              => implode(',', $imagePaths),
            'price'              => $this->request->getPost('price'),
            'stock_quantity'     => $this->request->getPost('stock_quantity'),
            'average_rating'     => 0, // ini penting kalau default di DB bukan null
            'created_at'         => date('Y-m-d H:i:s')
        ];

        if ($this->productModel->insert($data, false)) {
            $subCategories = $this->request->getPost('sub_categories') ?? [];
            foreach ($subCategories as $subCatID) {
                $this->productSubCategoriesModel->insert([
                    'id_product'      => $productID,
                    'id_sub_category' => $subCatID
                ]);
            }

            return redirect()->to('karyawan/admin/products/')->with('success', 'Product created successfully!');
        } else {
            log_message('error', 'Insert failed: ' . print_r($this->productModel->errors(), true));
            return redirect()->back()->withInput()->with('error', 'Failed to create product!');
        }
    }

    public function editProduct($id_product)
    {
        $product = $this->productModel->find($id_product);
        $masterCategories = $this->masterCategoriesModel->findAll();
        $selectedSubCats = $this->productSubCategoriesModel->where('id_product', $id_product)->findAll();
        $selectedSubCatIDs = array_column($selectedSubCats, 'id_sub_category');

        return view('employers/admin/products/edit', [
            'product' => $product,
            'masterCategories' => $masterCategories,
            'selectedSubCatIDs' => $selectedSubCatIDs
        ]);
    }

    public function updateProduct($id_product)
    {
        $validationRules = [
            'product_name' => 'required|min_length[3]|max_length[255]',
            'id_master_category' => 'required',
            'price' => 'required|numeric',
            'stock_quantity' => 'required|integer',
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('error', 'Data tidak valid!');
        }

        $product = $this->productModel->find($id_product);
        $file = $this->request->getFiles();
        $updatedImagePaths = $product['image'];

        if (!empty($file['images']) && isset($file['images'][0]) && $file['images'][0]->getError() !== 4) {
            $oldImages = explode(',', $product['image']);
            foreach ($oldImages as $oldImage) {
                $oldImagePath = FCPATH . trim($oldImage);
                if (file_exists($oldImagePath) && is_file($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            $newImagePaths = [];
            foreach ($file['images'] as $img) {
                if ($img->isValid() && !$img->hasMoved()) {
                    $newName = $img->getRandomName();
                    $uploadPath = FCPATH . 'uploads/img/products/';
                    if (!is_dir($uploadPath)) {
                        mkdir($uploadPath, 0777, true);
                    }
                    $img->move($uploadPath, $newName);
                    $newImagePaths[] = 'uploads/img/products/' . $newName;
                }
            }
            $updatedImagePaths = implode(',', $newImagePaths);
        }

        $data = [
            'product_name' => $this->request->getPost('product_name'),
            'id_master_category' => $this->request->getPost('id_master_category'),
            'description' => $this->request->getPost('description'),
            'price' => $this->request->getPost('price'),
            'stock_quantity' => $this->request->getPost('stock_quantity'),
            'image' => $updatedImagePaths,
            'updated_at' => date('Y-m-d H:i:s')
        ];

        if ($this->productModel->update($id_product, $data)) {
            $this->productSubCategoriesModel->where('id_product', $id_product)->delete();

            $subCategories = $this->request->getPost('sub_categories') ?? [];
            foreach ($subCategories as $subCatID) {
                $this->productSubCategoriesModel->insert([
                    'id_product' => $id_product,
                    'id_sub_category' => $subCatID
                ]);
            }

            return redirect()->to('/admin/product-list')->with('success', 'Product updated successfully!');
        }

        return redirect()->back()->with('error', 'Failed to update product!');
    }

    public function deleteProduct($id)
    {
        $product = $this->productModel->find($id);

        if ($product) {
            $images = explode(',', $product['image']);
            foreach ($images as $img) {
                $imgPath = FCPATH . trim($img);
                if (file_exists($imgPath)) {
                    unlink($imgPath);
                }
            }

            $this->productSubCategoriesModel->where('id_product', $id)->delete();
            $this->productModel->delete($id);

            return redirect()->to('/admin/product-list')->with('success', 'Product deleted successfully.');
        }

        return redirect()->to('/admin/product-list')->with('error', 'Product not found.');
    }

    // ... sisanya tetap seperti tampilDetail, showProduct, searchByCustomer/Admin
}
