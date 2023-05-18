<?php

namespace App\Controllers;

use App\Models\ArtikelModel;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class RilisMedia extends BaseController
{
    protected $artikelModel;
    protected $helpers = ['form'];

    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);

        $this->artikelModel = new ArtikelModel();
    }
    public function index()
    {
        $artikel = $this->artikelModel->paginate(1, 'artikel');
        $this->data['artikel'] = $artikel;
        $this->data['pager'] = $this->artikelModel->pager;
        $this->data['judul_halaman'] = 'Rilis Media';
        $this->view('rilismedia.php', $this->data);
    }

    public function detail($slug)
    {
        $artikel = $this->artikelModel->getArtikel($slug);

        // tampilan error kalau tidak ada slug artikel yang ada di database
        if(empty($artikel))
        {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Ruangan '.$slug.' tidak ditemukan.');
        }

        $this->data['artikel'] = $artikel;
        $this->view('detailrilismedia.php', $this->data);
    }
}
