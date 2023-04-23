<?php

namespace App\Controllers;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use App\Models\LayananModel;

class Layanan extends BaseController
{
    protected $layananModel;
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        parent::initController($request,$response,$logger);

        $this->layananModel = new LayananModel();

    }
    public function index()
    {
        $layanan = $this->layananModel->findAll();
        $this->data['layanan'] = $layanan;
        $this->data['judul_halaman'] = 'Layanan PDIN';
        $this->view('layanan.php', $this->data);
    }

}
