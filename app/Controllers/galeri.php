<?php

namespace App\Controllers;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use App\Models\GaleriRuanganModel;
use App\Models\GaleriAlatModel;
use App\Models\GaleriKegiatanModel;
use App\Models\GaleriModel;

class Galeri extends BaseController
{
	protected $galeriRuanganModel;

	protected $galeriAlatModel;

	protected $galeriKegiatanModel;

	protected $galeriModel;

	public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
	{
		parent::initController($request, $response, $logger);

		$this->galeriRuanganModel = new GaleriRuanganModel();
		$this->galeriAlatModel = new GaleriAlatModel();
		$this->galeriKegiatanModel = new GaleriKegiatanModel();
		$this->galeriModel = new GaleriModel();
	}

	public function index()
	{
		$keyword = $this->request->getVar('keyword');

		if ($keyword) {
			$galeri = $this->galeriModel->search($keyword);
		} else {
			$galeri = $this->galeriModel;
		}

		$this->data['judul_halaman'] = 'Galeri | Pusat Desain Industri Nasional';
		$this->data['current_page'] = 'galeri';
		// $this->data['galeri_alat'] = $this->galeriAlatModel->paginate(5, 'galeri');
		// $this->data['galeri_kegiatan'] = $this->galeriKegiatanModel->paginate(5, 'galeri');
		// $this->data['galeri_ruangan'] = $this->galeriRuanganModel->paginate(5, 'galeri');

		$this->data['galeri'] = $galeri->paginate(20, 'galeri');
		$this->data['pager'] = $this->galeriModel->pager;

		$galeri = array_merge($this->galeriAlatModel->findAll(), $this->galeriKegiatanModel->findAll(), $this->galeriRuanganModel->findAll());
		// $this->data['galeri'] = $galeri->paginate(10, 'galeri');

		$this->view('galeri.php', $this->data);
	}
}
