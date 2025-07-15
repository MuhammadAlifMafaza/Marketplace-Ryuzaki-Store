<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\MasterCategoriesModel;
use App\Models\SubCategoriesModel;

class CategoriesController extends BaseController
{
    protected $masterCategoryModel;
    protected $subCategoryModel;

    public function __construct()
    {
        $this->masterCategoryModel = new MasterCategoriesModel();
        $this->subCategoryModel = new SubCategoriesModel();
    }
    // ================= MASTER CATEGORIES ================= //

    // List all master categories
    public function index()
    {
        $data['masterCategories'] = $this->masterCategoryModel->findAll();
        $data['subCategories'] = $this->subCategoryModel->findAll();
        return view('employers/admin/categories/index.php', $data);
    }

    // Show form to create master category
    public function createMaster()
    {
        return view('employers/admin/categories/create_master');
    }

    // Generate unique ID for master category
    private function generateCategoryID($name)
    {
        $slug = url_title($name, '-', true); // ex: "Pakaian Pria" => "pakaian-pria"

        // Cek apakah slug itu belum ada
        if (!$this->masterCategoryModel->find($slug)) {
            return $slug;
        }

        // Kalau sudah ada, baru kasih suffix angka
        $index = 1;
        do {
            $newId = $slug . '-' . str_pad($index, 3, '0', STR_PAD_LEFT);
            $exists = $this->masterCategoryModel->find($newId);
            $index++;
        } while ($exists);

        return $newId;
    }

    // Save new master category
    public function storeMaster()
    {
        $name = $this->request->getPost('name_category');
        $description = $this->request->getPost('description');
        $inputId = $this->request->getPost('id_master_category');

        // Validasi dasar
        if (!$name) {
            return redirect()->back()->withInput()->with('error', 'Nama kategori wajib diisi.');
        }

        // Generate ID (override jika mau backend yang pastikan)
        $generatedId = $this->generateCategoryID($name);

        // Jika user masukkan ID yang tidak sesuai atau kosong, gunakan yang benar
        $finalId = ($inputId && strpos($inputId, url_title($name, '-', true)) === 0) ? $generatedId : $generatedId;

        // Cek unik
        if ($this->masterCategoryModel->find($finalId)) {
            return redirect()->back()->withInput()->with('error', 'ID kategori sudah ada. Coba nama lain.');
        }

        $this->masterCategoryModel->insert([
            'id_master_category' => $finalId,
            'name_category' => $name,
            'description' => $description
        ]);

        return redirect()->to('karyawan/admin/categories')->with('success', 'Kategori berhasil ditambahkan.');
    }

    // Edit master category
    public function editMaster($id)
    {
        $data['category'] = $this->masterCategoryModel->find($id);
        return view('employers/admin/categories/edit_master', $data);
    }

    // Update master category
    public function updateMaster($id)
    {
        $this->masterCategoryModel->update($id, [
            'name_category' => $this->request->getPost('name_category'),
            'description' => $this->request->getPost('description')
        ]);

        return redirect()->to('/categories');
    }

    // Delete master category
    public function deleteMaster($id)
    {
        $this->masterCategoryModel->delete($id);
        return redirect()->to('/categories');
    }

    // ================= SUB CATEGORIES ================= //

    // List subcategories for specific master
    public function subcategories($masterId)
    {
        $data['master'] = $this->masterCategoryModel->find($masterId);
        $data['subCategories'] = $this->subCategoryModel->where('id_master_category', $masterId)->findAll();
        return view('categories/subcategories', $data);
    }

    // Show form to add subcategory
    public function createSub($idMaster)
    {
        $master = $this->masterCategoryModel->find($idMaster);

        if (!$master) {
            return redirect()->to('/admin/categories')->with('error', 'Kategori utama tidak ditemukan.');
        }

        return view('employers/admin/categories/create_sub', ['master' => $master]);
    }

    // Generate unique ID for subcategory
    // This function generates a unique ID for subcategories based on the master category ID and the subcategory name.
    // It ensures that the ID is unique by appending a counter to the slugified name.
    private function generateSubCategoryID($name)
    {
        $slug = url_title($name, '-', true);

        // Cek apakah slug itu belum dipakai sebagai id_sub_category
        if (!$this->subCategoryModel->find($slug)) {
            return $slug;
        }

        // Kalau sudah dipakai, cari yang belum ada dengan suffix
        $index = 1;
        do {
            $newId = $slug . '-' . str_pad($index, 3, '0', STR_PAD_LEFT);
            $exists = $this->subCategoryModel->find($newId);
            $index++;
        } while ($exists);

        return $newId;
    }

    // Save new subcategory
    public function storeSub()
    {
        $name = $this->request->getPost('name_sub_category');
        $type = $this->request->getPost('type');
        $idMaster = $this->request->getPost('id_master_category');

        // Generate final ID (pastikan benar dari server-side)
        $generatedId = $this->generateSubCategoryID($name);

        // Cek duplikat ID
        if ($this->subCategoryModel->find($generatedId)) {
            return redirect()->back()->withInput()->with('error', 'ID subkategori sudah digunakan. Silakan ubah nama.');
        }

        $this->subCategoryModel->insert([
            'id_sub_category' => $generatedId,
            'id_master_category' => $idMaster,
            'name_sub_category' => $name,
            'type' => $type
        ]);

        return redirect()->to('admin/categories/')
            ->with('success', 'Subkategori berhasil ditambahkan.');
    }

    // Edit subcategory
    public function editSub($id)
    {
        $data['subCategory'] = $this->subCategoryModel->find($id);
        return view('categories/edit_sub', $data);
    }

    // Update subcategory
    public function updateSub($id)
    {
        $sub = $this->subCategoryModel->find($id);
        $this->subCategoryModel->update($id, [
            'name_sub_category' => $this->request->getPost('name_sub_category'),
            'type' => $this->request->getPost('type')
        ]);

        return redirect()->to('/categories/subcategories/' . $sub['id_master_category']);
    }

    // Delete subcategory
    public function deleteSub($id)
    {
        $sub = $this->subCategoryModel->find($id);
        $this->subCategoryModel->delete($id);

        return redirect()->to('/categories/subcategories/' . $sub['id_master_category']);
    }
}
