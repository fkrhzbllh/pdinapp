<?php

namespace App\Controllers;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use App\Models\KegiatanModel;
use App\Models\GaleriKegiatanModel;

class Kegiatan extends BaseController
{
	protected $kegiatanModel;

	protected $galeriKegiatanModel;

	public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
	{
		parent::initController($request, $response, $logger);
		$this->kegiatanModel = new KegiatanModel();
		$this->galeriKegiatanModel = new GaleriKegiatanModel();
		$this->data['judul_halaman'] = 'Kegiatan | Pusat Desain Industri Nasional';
		$this->data['current_page'] = 'kegiatan';
	}

	public function index()
	{
		$kegiatan = $this->kegiatanModel->findAll();

		foreach ($kegiatan as $key => $value) {
			$this->data['kegiatan'][$key]['title'] = $value['nama_kegiatan'];
			$this->data['kegiatan'][$key]['start'] = $value['tgl_mulai'];
			$this->data['kegiatan'][$key]['end'] = $value['tgl_selesai'];
			$this->data['kegiatan'][$key]['jenis_kegiatan'] = $value['jenis_kegiatan'];
			$this->data['kegiatan'][$key]['tipe_kegiatan'] = $value['tipe_kegiatan'];
			$this->data['kegiatan'][$key]['tempat'] = $value['tempat'];
			$this->data['kegiatan'][$key]['link_pendaftaran'] = $value['link_pendaftaran'];
			$this->data['kegiatan'][$key]['link_virtual'] = $value['link_virtual'];

			$this->data['kegiatan'][$key]['poster'] = base_url() . 'uploads/' . $value['poster'];
		}

		$this->data['kegiatan_mendatang_atau_terakhir'] = $this->kegiatanModel->getKegiatanMendatangAtauTerakhir();
		$this->data['kegiatan_terakhir'] = $this->kegiatanModel->getKegiatanTerakhir(5);

		return view('kegiatan.php', $this->data);
	}
}
