<?php

namespace App\Controllers;

class AturProfil extends BaseController
{
    public function index()
    {
        return view('atur-profil', $this->data);
    }
}
