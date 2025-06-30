<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class FiltersKaryawan implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();

        if (!$session->has('karyawan_logged_in')) {
            return redirect()->to('/karyawan/login');
            // Ganti ke route login karyawan
        }

        // Validasi jabatan jika ada argumen role tertentu
        if ($arguments && !in_array($session->get('jabatan'), $arguments)) {
            return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk mengakses halaman tersebut.');
        }
    }


    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null) {}
}
