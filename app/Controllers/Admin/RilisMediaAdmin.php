<?php

namespace App\Controllers\Admin;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use App\Models\PenyewaModel;
use App\Models\GaleriModel;
use App\Models\ArtikelModel;
use App\Controllers\BaseController;

class RilisMediaAdmin extends BaseController
{
	protected $penyewaModel;
	protected $galeriModel;
	protected $artikelModel;
	protected $helpers = ['form'];
	protected $faker;

	public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
	{
		parent::initController($request, $response, $logger);

		$this->penyewaModel = new PenyewaModel();
		$this->galeriModel = new GaleriModel();
		$this->artikelModel = new ArtikelModel();
		$this->helpers = ['form'];
		$this->data['judul_halaman'] = 'Admin | Pusat Desain Industri Nasional';
		$this->data['current_page'] = 'adminrilismedia';
		$this->data['admin'] = true;
		date_default_timezone_set('Asia/Jakarta');
		$this->faker = \Faker\Factory::create();
	}

	public function index()
	{
		// Jika session magicLogin masih berlaku, maka reset password
		if (session('magicLogin')) {
			return redirect()->route('atur-password');
		}

		$this->data['current_page'] = 'adminrilismedia';
		$perPage = 10;
		$this->data['per_page'] = $perPage;
		$this->data['artikel'] = $this->artikelModel->paginate($perPage, 'artikel');
		$this->data['pager'] = $this->artikelModel->pager;
		$this->data['pager_current'] = $this->artikelModel->pager->getCurrentPage('artikel');
		return view('admin/adminrilismedia.php', $this->data);
	}

	// form tambah artikel
	public function tambahRilisMedia()
	{
		$this->data['current_page'] = 'adminrilismedia';
		session();
		$this->data['admin'] = true;
		// $this->data['judul_halaman'] = 'Tambah kegiatan';

		return view('admin/formtambahartikel.php', $this->data);
	}

	// simpan tambah artikel
	public function saveTambahRilisMedia()
	{
		// dd($this->request->getFile('featured_image'));
		// aturan validasi
		$rules = $this->formRulesRilisMedia('required|is_unique[artikel.judul]');

		// cek validasi
		if (!$this->validate($rules)) {
			return redirect()->to('/DashboardAdmin/tambah-rilis-media')->withInput();
		}

		// ambil gambar
		$featured_image = $this->request->getFile('featured_image');

		if ($featured_image) {
			if ($featured_image->isValid() && !$featured_image->hasMoved()) {
				// pindahin ke folder
				$featured_image->move('uploads');
				// ambil nama foto
				$namafoto = $featured_image->getName();
			} else {
				$namafoto = null;
			}
		} else {
			$namafoto = null;
		}

		// simpan data tambah artikel
		$this->artikelModel->save([
			'judul' => $this->request->getVar('judul'),
			'slug' => url_title($this->request->getVar('judul')),
			'konten' => $this->request->getVar('konten'),
			'excerp' => $this->request->getVar('excerp'),
			'meta_description' => $this->request->getVar('meta_description'),
			'kategori' => $this->request->getVar('kategori'),
			'status' => $this->request->getVar('status'),
			'tgl_terbit' => $this->request->getVar('tgl_terbit'),
			'featured_image' => $namafoto,
		]);

		session()->setFlashdata('sukses', 'Data berhasil ditambahkan.');

		return redirect()->to('/DashboardAdmin/rilis-media');
	}

	// form update artikel
	public function updateRilisMedia($slug)
	{
		$this->data['current_page'] = 'adminrilismedia';
		$artikel = $this->artikelModel->getArtikel($slug);
		session();

		$this->data['admin'] = true;
		$this->data['artikel'] = $artikel;

		return view('admin/formeditartikel.php', $this->data);
	}

	// simpan tambah artikel
	public function saveUpdateRilisMedia($id)
	{
		$artikelLama = $this->artikelModel->getArtikelByID($id);
		$slugLama = $artikelLama['slug'];

		($slugLama == url_title($this->request->getVar('judul'))) ? $rules_nama = 'required' : $rules_nama = 'required|is_unique[artikel.judul]';

		// aturan validasi
		$rules = $this->formRulesRilisMedia($rules_nama);

		// cek validasi
		if (!$this->validate($rules)) {
			return redirect()->to('/DashboardAdmin/update-rilis-media/' . $slugLama)->withInput();
		}

		// dd($this->request->getFile('poster'));
		// ambil gambar
		$featured_image = $this->request->getFile('featured_image');
		// dd($featured_image);

		// delete gambar
		if ($artikelLama['featured_image']) {
			if (file_exists('uploads/' . $artikelLama['featured_image'])) {
				// if (file_exists(ROOTPATH . 'public/uploads/' . $artikelLama['featured_image'])) {
				unlink('uploads/' . $artikelLama['featured_image']);
				// unlink(ROOTPATH . 'public/uploads/' . $artikelLama['featured_image']);
			}
		}

		if ($featured_image) {
			if ($featured_image->isValid() && !$featured_image->hasMoved()) {
				// pindahin ke folder
				$featured_image->move('uploads');
				// ambil nama foto
				$namafoto = $featured_image->getName();
			} else {
				$namafoto = null;
			}
		} else {
			$namafoto = null;
		}

		// simpan data update artikel
		$this->artikelModel->save([
			'id' => $id,
			'judul' => $this->request->getVar('judul'),
			'slug' => url_title($this->request->getVar('judul')),
			'konten' => $this->request->getVar('konten'),
			'excerp' => $this->request->getVar('excerp'),
			'meta_description' => $this->request->getVar('meta_description'),
			'kategori' => $this->request->getVar('kategori'),
			'status' => $this->request->getVar('status'),
			'tgl_terbit' => $this->request->getVar('tgl_terbit'),
			'featured_image' => $namafoto,
		]);

		session()->setFlashdata('sukses', 'Data berhasil diubah.');

		return redirect()->to('/DashboardAdmin/rilis-media');
	}

	// delete artikel
	public function deleteRilisMedia($id)
	{
		$artikel = $this->artikelModel->getArtikelByID($id);
		// hapus gambar
		if ($artikel) {
			if ($artikel['featured_image']) {
				if (file_exists('uploads/' . $artikel['featured_image'])) {
					unlink('uploads/' . $artikel['featured_image']);
				}
			}
			$this->artikelModel->delete($id);
		}

		session()->setFlashdata('sukses', 'Data berhasil dihapus.');

		return redirect()->to('/DashboardAdmin/rilis-media');
	}

	// aturan validasi form artikel
	public function formRulesRilisMedia($rules_nama)
	{
		$rules = [
			'judul' => [
				'rules' => $rules_nama,
				'errors' => [
					'required' => 'judul harus diisi',
					'is_unique' => ' judul sudah ada'
				]
			],
			'konten' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'konten harus diisi',
				]
			],
			'status' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'status harus diisi',
				]
			],
			'tgl_terbit' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'tanggal terbit harus diisi'
				]
			],
			'featured_image' => [
				'rules' => 'uploaded[featured_image]|is_image[featured_image]|mime_in[featured_image,image/jpg,image/jpeg,image/png]',
				'errors' => [
					'uploaded' => 'gambar harus diisi',
					'is_image' => 'file yang Anda pilih bukan gambar',
					'mime_in' => 'file yang Anda pilih bukan gambar'
				]
			]
		];

		return $rules;
	}
}
