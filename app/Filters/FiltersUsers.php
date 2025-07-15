<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class FiltersUsers implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();

        // Cek jika tidak ada session user
        if (!$session->has('user_logged_in')) {
            return redirect()->to('/login'); // Ganti ke route login user
        }

        // Validasi role jika perlu (misal hanya customer)
        if ($arguments && !in_array($session->get('role'), $arguments)) {
            return redirect()->to('/unauthorized'); // Halaman tidak diizinkan
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null) {}
}
