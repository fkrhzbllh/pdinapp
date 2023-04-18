<?php

namespace App\Controllers;

class Faq extends BaseController
{
    public function index()
    {
        $this->view('faq.php');
    }
}
