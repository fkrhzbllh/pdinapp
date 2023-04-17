<?php

namespace App\Controllers;

class Artikel extends BaseController
{
    public function index()
    {
        $this->view('artikel.php');
    }

}
