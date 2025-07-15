<?php

namespace App\Controllers;

use App\Models\AdminModel;

class DataController extends BaseController
{
    public function indexDataAdmin()
    {
        $adminModel = new AdminModel();
        $data['admins'] = $adminModel->findAll();  // Ambil semua data admin
        return view('\admin\data\admin\index', $data);
    }

    public function createDataAdmin()
    {
        return view('\admin\data\admin\create');  // Tampilkan form tambah admin
    }

    public function saveDataAdmin()
    {
        $adminModel = new AdminModel();

        // Validasi data input
        $validationRules = [
            'username' => 'required|is_unique[admin.username]',
            'email' => 'required|is_unique[admin.email]',
            'password' => 'required|min_length[6]',
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->to('/admin/create')->withInput();
        }

        // Data untuk disimpan
        $data = [
            'id_admin' => uniqid('ADM'),  // ID Admin unik
            'username' => $this->request->getVar('username'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            'full_name' => $this->request->getVar('full_name'),
            'email' => $this->request->getVar('email'),
            'phone_number' => $this->request->getVar('phone_number'),
            'address' => $this->request->getVar('address'),
            'department' => $this->request->getVar('department'),
        ];

        // Simpan data
        $adminModel->save($data);

        return redirect()->to('/admin')->with('message', 'Admin added successfully');
    }

    public function editDataAdmin($id_admin)
    {
        $adminModel = new AdminModel();
        $data['admin'] = $adminModel->getAdmin($id_admin);  // Ambil data admin berdasarkan ID
        return view('\admin\data\admin\edit', $data);
    }

    public function updateDataAdmin($id_admin)
    {
        $adminModel = new AdminModel();

        // Validasi data input
        $validationRules = [
            'username' => 'required',
            'email' => 'required',
            'password' => 'required|min_length[6]',
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->to('/admin/edit/' . $id_admin)->withInput();
        }

        // Data untuk diperbarui
        $data = [
            'username' => $this->request->getVar('username'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            'full_name' => $this->request->getVar('full_name'),
            'email' => $this->request->getVar('email'),
            'phone_number' => $this->request->getVar('phone_number'),
            'address' => $this->request->getVar('address'),
            'department' => $this->request->getVar('department'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        // Update data
        $adminModel->update($id_admin, $data);

        return redirect()->to('/admin')->with('message', 'Admin updated successfully');
    }

    public function deleteDataAdmin($id_admin)
    {
        $adminModel = new AdminModel();
        $adminModel->delete($id_admin);  // Hapus data admin berdasarkan ID
        return redirect()->to('/admin')->with('message', 'Admin deleted successfully');
    }

    // data customer
    public function indexDataCustomer()
    {
        return view('\owner\data\customer\index.php');
    }
    
    // data owner
    public function indexDataOwner()
    {
        return view('\owner\data\owner\index.php');
    }
}
