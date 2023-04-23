<?php

namespace App\Controllers;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class Beranda extends BaseController
{
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        parent::initController($request,$response,$logger);
        $this->data['judul_halaman'] = 'PDIN';
    }

    public function index()
    {
        $this->view('beranda.php', $this->data);
    }

    public function coba()
    {
        $this->view('coba.php');
    }
}
