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

        if (!$session->has('isLoggedInUser')) {
            return redirect()->to('/auth/login');
        }

        $expectedRole = $arguments[0] ?? null;
        $userRole = $session->get('role');

        if ($expectedRole && $userRole !== $expectedRole) {
            return redirect()->to('/auth/login');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null) {}
}
