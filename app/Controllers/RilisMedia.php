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

		$this->data['judul_halaman'] = 'Rilis Media | Pusat Desain Industri Nasional';
		$this->data['current_page'] = 'rilismedia';
	}

	public function index()
	{
		$keyword = $this->request->getVar('keyword');

		if ($keyword) {
			$artikel = $this->artikelModel->search($keyword);
		} else {
			$artikel = $this->artikelModel;
		}

		$this->data['artikel'] = $artikel->paginate(3, 'artikel');
		$this->data['pager'] = $this->artikelModel->pager;

		$this->view('rilismedia.php', $this->data);
	}

	public function detail($slug)
	{
		$artikel = $this->artikelModel->getArtikel($slug);

		// tampilan error kalau tidak ada slug artikel yang ada di database
		if (empty($artikel)) {
			throw new \CodeIgniter\Exceptions\PageNotFoundException('Ruangan ' . $slug . ' tidak ditemukan.');
		}

		$this->data['artikel'] = $artikel;
		$this->view('detailrilismedia.php', $this->data);
	}
}
