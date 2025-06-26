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

        if (!$session->has('isLoggedInKaryawan')) {
            return redirect()->to('/karyawan/login');
        }

        $expectedJabatan = $arguments[0] ?? null;
        $userJabatan = $session->get('jabatan');

        if ($expectedJabatan && $userJabatan !== $expectedJabatan) {
            return redirect()->to('/login');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null) {}
}
