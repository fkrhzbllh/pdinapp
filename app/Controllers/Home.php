<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $this->view('beranda.php');
    }

    public function coba()
    {
        $this->view('coba.php');
    }
}
