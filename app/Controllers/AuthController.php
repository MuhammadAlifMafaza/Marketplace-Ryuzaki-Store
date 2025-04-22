<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class AuthController extends BaseController
{
    public function login()
    {
        return view('auth/login');
    }

    public function processLogin()
    {
        return view('auth/login');
    }

    public function register()
    {
        return view('auth/register');
    }

    public function processRegister()
    {
        return view('auth/login');
    }

    public function forgotPassword()
    {
        return view('auth/forgot-password');
    }

    public function logout()
    {
        return view('auth/login');
    }
}
