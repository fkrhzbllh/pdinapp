<?php

namespace App\Controllers;

use App\Models\KegiatanModel;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class Beranda extends BaseController
{
	protected $kegiatanModel;

	public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
	{
		parent::initController($request, $response, $logger);

		$this->kegiatanModel = new KegiatanModel();
		$this->data['judul_halaman'] = 'Beranda | Pusat Desain Industri Nasional';
		$this->data['current_page'] = 'beranda';
	}

	public function index()
	{
		$kegiatan = $this->kegiatanModel->findAll();

		if ($kegiatan) {
			foreach ($kegiatan as $key => $value) {
				$this->data['jadwal_kegiatan'][$key]['title'] = $value['nama_kegiatan'];
				$this->data['jadwal_kegiatan'][$key]['start'] = $value['tgl_mulai'];
				$this->data['jadwal_kegiatan'][$key]['end'] = $value['tgl_selesai'];
			}
		} else {
			$this->data['jadwal_kegiatan'] = '';
		}

		$this->view('beranda.php', $this->data);
	}

	public function coba()
	{
		$this->view('coba.php');
	}
}
