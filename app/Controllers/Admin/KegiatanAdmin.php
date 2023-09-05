<?php

namespace App\Controllers\Admin;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use App\Models\UsersModel;
use App\Models\GaleriModel;
use App\Models\KegiatanModel;
use App\Controllers\BaseController;

class DashboardAdmin extends BaseController
{
	protected $usersModel;
	protected $galeriModel;
	protected $kegiatanModel;
	protected $helpers = ['form'];
	protected $faker;

	public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
	{
		parent::initController($request, $response, $logger);

		$this->usersModel = new UsersModel();
		$this->galeriModel = new GaleriModel();
		$this->kegiatanModel = new KegiatanModel();
		$this->helpers = ['form'];
		$this->data['judul_halaman'] = 'Admin | Pusat Desain Industri Nasional';
		$this->data['current_page'] = 'adminkegiatan';
		$this->data['admin'] = true;
		date_default_timezone_set('Asia/Jakarta');
		$this->faker = \Faker\Factory::create();
	}

	public function index()
	{
		$this->data['current_page'] = 'adminkegiatan';
		$perPage = 10;
		$this->data['per_page'] = $perPage;
		$this->data['artikel'] = $this->artikelModel->paginate($perPage, 'artikel');
		$this->data['pager'] = $this->artikelModel->pager;
		$this->data['pager_current'] = $this->artikelModel->pager->getCurrentPage('artikel');
		return view('admin/adminkegiatan.php', $this->data);
	}

	public function kegiatan()
	{
		$this->data['current_page'] = 'adminkegiatan';
		$perPage = 10;
		$this->data['per_page'] = $perPage;
		$this->data['kegiatan'] = $this->kegiatanModel->paginate($perPage, 'kegiatan');
		$this->data['pager'] = $this->kegiatanModel->pager;
		$this->data['pager_current'] = $this->kegiatanModel->pager->getCurrentPage('kegiatan');
		return view('admin/adminkegiatan.php', $this->data);
	}

	// form tambah kegiatan
	public function tambahKegiatan()
	{
		$this->data['current_page'] = 'adminkegiatan';
		session();
		$this->data['admin'] = true;
		// $this->data['judul_halaman'] = 'Tambah kegiatan';

		return view('admin/formtambahkegiatan.php', $this->data);
	}

	// simpan tambah kegiatan
	public function saveTambahKegiatan()
	{
		// aturan validasi
		$rules = $this->formRulesKegiatan('required|is_unique[kegiatan.nama_kegiatan]');

		// cek validasi
		if (!$this->validate($rules)) {
			return redirect()->to('/DashboardAdmin/tambah-kegiatan')->withInput();
		}

		// ambil gambar
		$poster = $this->request->getFile('poster');

		if ($poster) {
			if ($poster->isValid() && !$poster->hasMoved()) {
				// pindahin ke folder
				$poster->move('uploads');
				// ambil nama foto
				$namafoto = $poster->getName();
			} else {
				$namafoto = null;
			}
		} else {
			$namafoto = null;
		}

		// simpan data tambah kegiatan
		$this->kegiatanModel->save([
			'nama_kegiatan' => $this->request->getVar('nama_kegiatan'),
			'slug' => url_title($this->request->getVar('nama_kegiatan')),
			'jenis_kegiatan' => $this->request->getVar('jenis_kegiatan'),
			'tipe_kegiatan' => $this->request->getVar('tipe_kegiatan'),
			'tempat' => $this->request->getVar('tempat'),
			'tgl_mulai' => $this->request->getVar('tgl_mulai'),
			'tgl_selesai' => $this->request->getVar('tgl_selesai'),
			'link_pendaftaran' => $this->request->getVar('link_pendaftaran'),
			'link_virtual' => $this->request->getVar('link_virtual'),
			'poster' => $namafoto,
		]);

		session()->setFlashdata('sukses', 'Data berhasil ditambahkan.');

		return redirect()->to('/DashboardAdmin/kegiatan');
	}

	// form update kegiatan
	public function updateKegiatan($slug)
	{
		$this->data['current_page'] = 'adminkegiatan';
		$kegiatan = $this->kegiatanModel->getKegiatan($slug);
		session();

		$this->data['admin'] = true;
		$this->data['kegiatan'] = $kegiatan;

		return view('admin/formeditkegiatan.php', $this->data);
	}

	// simpan tambah kegiatan
	public function saveUpdateKegiatan($id)
	{
		$slugLama = $this->request->getVar('slug');

		($slugLama == url_title($this->request->getVar('nama_kegiatan'))) ? $rules_nama = 'required' : $rules_nama = 'required|is_unique[kegiatan.nama_kegiatan]';

		// aturan validasi
		$rules = $this->formRulesKegiatan($rules_nama);

		// cek validasi
		if (!$this->validate($rules)) {
			return redirect()->to('/DashboardAdmin/update-kegiatan')->withInput();
		}

		// dd($this->request->getFile('poster'));
		// ambil gambar
		$poster = $this->request->getFile('poster');
		// dd($poster);

		// delete gambar
		$kegiatanLama = $this->kegiatanModel->getKegiatanByID($id);
		if ($kegiatanLama['poster']) {
			unlink('uploads/' . $kegiatanLama['poster']);
		}

		if ($poster) {
			if ($poster->isValid() && !$poster->hasMoved()) {
				// pindahin ke folder
				$poster->move('uploads');
				// ambil nama foto
				$namafoto = $poster->getName();
			} else {
				$namafoto = null;
			}
		} else {
			$namafoto = null;
		}

		// simpan data update kegiatan
		$this->kegiatanModel->save([
			'id' => $id,
			'nama_kegiatan' => $this->request->getVar('nama_kegiatan'),
			'slug' => url_title($this->request->getVar('nama_kegiatan')),
			'jenis_kegiatan' => $this->request->getVar('jenis_kegiatan'),
			'tipe_kegiatan' => $this->request->getVar('tipe_kegiatan'),
			'tempat' => $this->request->getVar('tempat'),
			'tgl_mulai' => $this->request->getVar('tgl_mulai'),
			'tgl_selesai' => $this->request->getVar('tgl_selesai'),
			'link_pendaftaran' => $this->request->getVar('link_pendaftaran'),
			'link_virtual' => $this->request->getVar('link_virtual'),
			'poster' => $namafoto,
		]);

		session()->setFlashdata('sukses', 'Data berhasil diubah.');

		return redirect()->to('/DashboardAdmin/kegiatan');
	}

	// delete kegiatan
	public function deleteKegiatan($id)
	{
		$kegiatan = $this->kegiatanModel->getKegiatanByID($id);
		if ($kegiatan) {
			if ($kegiatan['poster']) {
				unlink('uploads/' . $kegiatan['poster']);
			}
			$this->kegiatanModel->delete($id);
		}

		session()->setFlashdata('sukses', 'Data berhasil dihapus.');

		return redirect()->to('/DashboardAdmin/kegiatan');
	}

	// aturan validasi form kegiatan
	public function formRulesKegiatan($rules_nama)
	{
		$rules = [
			'nama_kegiatan' => [
				'rules' => $rules_nama,
				'errors' => [
					'required' => 'nama kegiatan harus diisi',
					'is_unique' => ' nama kegiatan sudah ada'
				]
			],
			'jenis_kegiatan' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'jenis kegiatan harus diisi',
				]
			],
			'tipe_kegiatan' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'tipe kegiatan harus diisi',
				]
			],
			'tempat' => [
				'rules' => 'required',
				'errors' => [
					'required' => '{field} harus diisi'
				]
			],
			'tgl_mulai' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'tanggal mulai harus diisi'
				]
			],
			'poster' => [
				'rules' => 'max_size[poster,2048]|is_image[poster]|mime_in[poster,image/jpg,image/jpeg,image/png]',
				'errors' => [
					'max_size' => 'ukuran foto ruangan maksimal 2MB',
					'is_image' => 'file yang Anda pilih bukan gambar',
					'mime_in' => 'file yang Anda pilih bukan gambar'
				]
			]
		];

		return $rules;
	}
}
