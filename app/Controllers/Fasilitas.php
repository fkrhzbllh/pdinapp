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
        // $ruangan = $this->ruanganModel->findAll();
        // $alat = $this->alatModel->findAll();
        // $this->data['ruangan'] = $this->ruanganModel->getRuang();
        // $this->data['alat'] = $this->alatModel->getAlat();
        // $this->data['judul_halaman'] = 'Fasilitas PDIN';
        $this->data = [
            'ruangan' => $this->ruanganModel->getRuangan(),
            'alat' => $this->alatModel->getAlat(),
            'judul_halaman' => 'Fasilitas PDIN'
        ];
        $this->view('fasilitas.php', $this->data);
    }

    public function detailRuangan($slug)
    {
        $ruangan = $this->ruanganModel->getRuangan($slug);
        $jadwal = $this->ruanganModel->getJadwalSewaRuangan($ruangan['id']);

        foreach ($jadwal as $key => $value) {
            $this->data['jadwal_sewa'][$key]['title'] = $value['nama_kegiatan'];
            $this->data['jadwal_sewa'][$key]['start'] = $value['tgl_mulai_sewa'];
            $this->data['jadwal_sewa'][$key]['end'] = $value['tgl_akhir_sewa'];
            $this->data['jadwal_sewa'][$key]['backgroundColor'] = "#00a65a";
        }
        
        $this->data['ruangan'] = $this->ruanganModel->getRuangan($slug);
        $this->data['judul_halaman'] = 'Detail Ruangan';

        $this->view('detailruangan.php',$this->data);
    }

    public function detailAlat($slug)
    {
        $alat = $this->alatModel->getAlat($slug);
        $jadwal = $this->alatModel->getJadwalSewaAlat($alat['id']);

        foreach ($jadwal as $key => $value) {
            $this->data['jadwal_sewa'][$key]['title'] = $value['nama_kegiatan'];
            $this->data['jadwal_sewa'][$key]['start'] = $value['tgl_mulai_sewa'];
            $this->data['jadwal_sewa'][$key]['end'] = $value['tgl_akhir_sewa'];
            $this->data['jadwal_sewa'][$key]['backgroundColor'] = "#00a65a";
        }
        
        $this->data['alat'] = $this->alatModel->getAlat($slug);
        $this->data['judul_halaman'] = 'Detail Alat';

        $this->view('detailalat.php',$this->data);
    }
}
