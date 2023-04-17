<?php

namespace App\Controllers;

class Galeri extends BaseController
{
    public function index()
    {
        $this->view('galeri.php');
    }
}
