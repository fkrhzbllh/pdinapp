<?php

namespace App\Controllers;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use App\Models\KegiatanModel;

class Kegiatan extends BaseController
{
    protected $kegiatanModel;

    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        parent::initController($request,$response,$logger);
        $this->kegiatanModel = new KegiatanModel();
    }
    public function index()
    {
        $kegiatan = $this->kegiatanModel->findAll();
        // $this->data['kegiatan'] = $kegiatan;
        foreach ($kegiatan as $key => $value) {
            $this->data['kegiatan'][$key]['title'] = $value['nama_kegiatan'];
            $this->data['kegiatan'][$key]['start'] = $value['tgl_mulai'];
            $this->data['kegiatan'][$key]['end'] = $value['tgl_selesai'];
            $this->data['kegiatan'][$key]['backgroundColor'] = "#00a65a";
        }

        // $this->data['kegiatan']['title'] = $kegiatan[0]['nama_kegiatan'];
        // $this->data['kegiatan']['start'] = $kegiatan[0]['tgl_mulai'];
        // $this->data['kegiatan']['end'] = $kegiatan[0]['tgl_selesai'];
        // $this->data['kegiatan']['backgroundColor'] = "#00a65a";
        
        $this->data['judul_halaman'] = 'Kegiatan PDIN';
        $this->view('kegiatan.php',$this->data);
    }

}
