<?php

namespace App\Controllers;

class Login extends BaseController
{
    public function index()
    {
        $this->view('login.php');
    }
}