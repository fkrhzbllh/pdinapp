<?php

namespace App\Controllers;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use App\Models\RuanganModel;
use App\Models\AlatModel;

class Fasilitas extends BaseController
{
    protected $ruanganModel;
    protected $alatModel;

    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        parent::initController($request,$response,$logger);

        $this->ruanganModel = new RuanganModel();
        $this->alatModel = new AlatModel();
    }

    public function index()
    {
        $ruangan = $this->ruanganModel->findAll();
        $alat = $this->alatModel->findAll();
        $this->data['ruangan'] = $ruangan;
        $this->data['alat'] = $alat;
        $this->data['judul_halaman'] = 'Fasilitas PDIN';
        $this->view('fasilitas.php', $this->data);
    }
}
