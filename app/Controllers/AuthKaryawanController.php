<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KaryawanModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\ResponseInterface;

class AuthKaryawanController extends BaseController
{
    protected $karyawanModel;
    protected $session;

    public function __construct()
    {
        $this->karyawanModel = new KaryawanModel();
        $this->session = session();
    }

    public function login()
    {
        if ($this->session->get('logged_in')) {
            switch ($this->session->get('jabatan')) {
                case 'admin':
                    return redirect()->to('karyawan/admin/dashboard');
                case 'kurir':
                    return redirect()->to('karyawan/admin/dashboard');
                case 'owner':
                    return redirect()->to('karyawan/admin/dashboard');
            }
        }

        return view('employers/auth/login');
    }

    public function loginProcess()
    {
        $loginInput = $this->request->getPost('login'); // Bisa username atau email
        $password = $this->request->getPost('password');

        // Cari user berdasarkan username atau email
        $user = $this->karyawanModel
            ->where('username', $loginInput)
            ->orWhere('email', $loginInput)
            ->first();

        if (!$user) {
            return redirect()->back()->with('error', 'Username atau email tidak ditemukan.');
        }

        // Verifikasi password
        if (!password_verify($password, $user['password'])) {
            return redirect()->back()->with('error', 'Password salah.');
        }

        // Simpan data user ke session
        $this->session->set([
            'id_karyawan' => $user['id_karyawan'],
            'username' => $user['username'],
            'email' => $user['email'],
            'img_profile' => $user['img_profile'],
            'full_name' => $user['full_name'],
            'jabatan' => $user['jabatan'],
            'karyawan_logged_in' => true,
            'logged_in' => true,
        ]);

        // Arahkan berdasarkan jabatan/role
        switch ($user['jabatan']) {
            case 'admin':
                return redirect()->to('karyawan/admin/dashboard');
            case 'kurir':
                return redirect()->to('karyawan/admin/dashboard');
            case 'owner':
                return redirect()->to('karyawan/admin/dashboard');
            default:
                return redirect()->to('karyawan/dashboard');
        }
    }

    public function forgotPassword()
    {
        return view('employers/auth/forgot-password');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/karyawan/login');
    }
}
