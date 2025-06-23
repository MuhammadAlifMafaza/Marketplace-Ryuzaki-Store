<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class AuthUserController extends BaseController
{
    // Function untuk login customer
    public function login()
    {

        return view('users/login.php');
    }
    public function loginProcess()
    {

        return redirect()->to('');
    }
    public function register()
    {

        return view('users/register.php');
    }
    public function registerProcess()
    {

        return redirect()->to('users/login');
    }
    public function forgotPassword()
    {

        return view('users/forgot-password.php');
    }
    public function forgotPasswordProcess()
    {

        return view('users/forgot-password.php');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('customerAuth/login');
    }
}
