<?php

namespace App\Controllers;

class Kegiatan extends BaseController
{
    public function index()
    {
        $this->view('kegiatan.php');
    }

}
