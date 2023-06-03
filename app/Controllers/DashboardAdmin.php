<?php

namespace App\Controllers;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use App\Models\RuanganModel;
use App\Models\AlatModel;
use App\Models\SewaRuanganModel;
use App\Models\SewaAlatModel;
use App\Models\UserModel;
use App\Models\GaleriRuanganModel;
use App\Models\GaleriAlatModel;
use App\Models\GaleriModel;
use App\Models\ArtikelModel;
use App\Models\KegiatanModel;

class DashboardAdmin extends BaseController
{
	protected $ruanganModel;

	protected $alatModel;

	protected $sewaRuanganModel;

	protected $sewaAlatModel;

	protected $userModel;

	protected $galeriRuanganModel;

	protected $galeriAlatModel;

	protected $galeriModel;

	protected $artikelModel;

	protected $kegiatanModel;

	protected $helpers = ['form'];

	public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
	{
		parent::initController($request, $response, $logger);

		$this->ruanganModel = new RuanganModel();
		$this->alatModel = new AlatModel();
		$this->sewaRuanganModel = new SewaRuanganModel();
		$this->sewaAlatModel = new SewaAlatModel();
		$this->userModel = new UserModel();
		$this->galeriRuanganModel = new GaleriRuanganModel();
		$this->galeriAlatModel = new GaleriAlatModel();
		$this->galeriModel = new GaleriModel();
		$this->artikelModel = new ArtikelModel();
		$this->kegiatanModel = new KegiatanModel();
		$this->helpers = ['form'];
		$this->data['judul_halaman'] = 'Admin | Pusat Desain Industri Nasional';
		$this->data['current_page'] = 'fasilitas';
		$this->data['admin'] = true;
	}

	public function index()
	{
		$this->data['current_page'] = 'adminrilismedia';
		$perPage = 10;
		$this->data['per_page'] = $perPage;
		$this->data['artikel'] = $this->artikelModel->paginate($perPage, 'artikel');
		$this->data['pager'] = $this->artikelModel->pager;
		$this->data['pager_current'] = $this->artikelModel->pager->getCurrentPage('artikel');
		$this->viewAdmin('adminrilismedia.php', $this->data);
	}

	public function alat()
	{
		$this->data['current_page'] = 'adminalat';
		// $perPage = 10;
		// $this->data['per_page'] = $perPage;
		// $this->data['alat'] = $this->alatModel->paginate($perPage, 'alat');
		$this->data['alat'] = $this->alatModel->findAll();
		// $this->data['pager'] = $this->alatModel->pager;
		// $this->data['pager_current'] = $this->alatModel->pager->getCurrentPage('alat');
		$this->viewAdmin('adminalat.php', $this->data);
	}

	public function ruangan()
	{
		$this->data['current_page'] = 'adminruangan';
		// $perPage = 10;
		// $this->data['per_page'] = $perPage;
		// $this->data['ruangan'] = $this->ruanganModel->paginate($perPage, 'ruangan');
		$this->data['ruangan'] = $this->ruanganModel->findAll();
		// $this->data['pager'] = $this->ruanganModel->pager;
		// $this->data['pager_current'] = $this->ruanganModel->pager->getCurrentPage('ruangan');
		$this->viewAdmin('adminruangan.php', $this->data);
	}

	public function kegiatan()
	{
		$this->data['current_page'] = 'adminkegiatan';
		$perPage = 10;
		$this->data['per_page'] = $perPage;
		$this->data['kegiatan'] = $this->kegiatanModel->paginate($perPage, 'kegiatan');
		// $this->data['kegiatan'] = $this->kegiatanModel->findAll();
		$this->data['pager'] = $this->kegiatanModel->pager;
		$this->data['pager_current'] = $this->kegiatanModel->pager->getCurrentPage('kegiatan');
		$this->viewAdmin('adminkegiatan.php', $this->data);
	}

	// form tambah ruangan
	public function tambahRuangan()
	{
		session();
		$this->data['admin'] = true;
		$this->data['current_page'] = 'adminruangan';
		// $this->data['judul_halaman'] = 'Tambah Ruangan';

		$this->viewAdmin('formtambahruangan.php', $this->data);
	}

	// simpan tambah ruangan
	public function saveTambahRuangan()
	{
		$this->data['current_page'] = 'adminruangan';
		// aturan validasi
		$rules = $this->formRulesRuangan('required|is_unique[ruangan.nama]');

		// cek validasi
		if (!$this->validate($rules)) {
			return redirect()->to('/DashboardAdmin/tambah-ruangan')->withInput();
		}

		// dd($this->request->getVar());
		// dd($this->request->getFileMultiple('fotoruangan'));

		$panjang = $this->request->getVar('panjang');
		$lebar = $this->request->getVar('lebar');
		$tinggi = $this->request->getVar('tinggi');
		$ukuran = $panjang . 'm x ' . $lebar . 'm x ' . $tinggi . 'm';
		$luas = $panjang * $lebar;

		// simpan data tambah ruangan
		$this->ruanganModel->save([
			'nama' => $this->request->getVar('nama'),
			'slug' => url_title($this->request->getVar('nama')),
			'deskripsi' => $this->request->getVar('deskripsiRuangan'),
			'tipe' => $this->request->getVar('tipe'),
			'lantai' => $this->request->getVar('lantai'),
			'kapasitas' => $this->request->getVar('kapasitas'),
			'ukuran' => $ukuran,
			'luas' => $luas,
			'fasilitas' => $this->request->getVar('fasilitas'),
			'biaya_sewa' => $this->request->getVar('biayasewa'),
		]);

		$idRuangan = $this->ruanganModel->insertID();

		// ambil gambar
		$fotoruangan = $this->request->getFileMultiple('fotoruangan');

		if ($fotoruangan) {
			foreach ($fotoruangan as $f) {
				if ($f->isValid() && !$f->hasMoved()) {
					// pindahin ke folder
					$f->move('uploads');
					// ambil nama foto
					$namafoto = $f->getName();
					// simpan ke database
					$this->galeriModel->save([
						'nama_file' => $namafoto,
					]);
					$this->galeriRuanganModel->save([
						'id_galeri' => $this->galeriModel->insertID(),
						'id_ruangan' => $idRuangan
					]);
				}
			}
		}

		// get slug
		$ruangan = $this->ruanganModel->getRuanganByID($idRuangan);
		$namaRuangan = $ruangan['slug'];

		session()->setFlashdata('sukses', 'Data berhasil ditambahkan.');

		return redirect()->to('/DashboardAdmin/ruangan');
	}

	// form update ruangan
	public function updateRuangan($slug)
	{
		$this->data['current_page'] = 'adminruangan';
		$ruangan = $this->ruanganModel->getRuangan($slug);
		session();

		if ($ruangan['ukuran'] != null || $ruangan['ukuran'] != '-') {
			$ukuran = explode(' x ', str_replace('m', '', $ruangan['ukuran']));
			$panjang = $ukuran[0];
			$lebar = $ukuran[1];
			$tinggi = $ukuran[2];
		} else {
			$panjang = 0;
			$lebar = 0;
			$tinggi = 0;
		}
		$this->data['admin'] = true;
		// $this->data['judul_halaman'] = 'Tambah Ruangan';
		$this->data['ruangan'] = $ruangan;
		$this->data['panjang'] = $panjang;
		$this->data['lebar'] = $lebar;
		$this->data['tinggi'] = $tinggi;
		$this->data['fotoruangan'] = $this->galeriRuanganModel->getGaleriByRuangan($ruangan['id']);

		$this->viewAdmin('formeditruangan.php', $this->data);
	}

	// simpan tambah ruangan
	public function saveUpdateRuangan($id)
	{
		$this->data['current_page'] = 'adminruangan';
		$slugLama = $this->request->getVar('slug');

		($slugLama == url_title($this->request->getVar('nama'))) ? $rules_nama = 'required' : $rules_nama = 'required|is_unique[ruangan.nama]';

		// aturan validasi
		$rules = $this->formRulesRuangan($rules_nama);

		// cek validasi
		if (!$this->validate($rules)) {
			return redirect()->to('/DashboardAdmin/update-ruangan')->withInput();
		}

		// dd($this->request->getVar());
		// dd($this->request->getFileMultiple('fotoruangan'));

		$panjang = $this->request->getVar('panjang');
		$lebar = $this->request->getVar('lebar');
		$tinggi = $this->request->getVar('tinggi');
		$ukuran = $panjang . 'm x ' . $lebar . 'm x ' . $tinggi . 'm';
		$luas = $panjang * $lebar;

		// simpan data update ruangan
		$this->ruanganModel->save([
			'id' => $id,
			'nama' => $this->request->getVar('nama'),
			'slug' => url_title($this->request->getVar('nama')),
			'deskripsi' => $this->request->getVar('deskripsiRuangan'),
			'tipe' => $this->request->getVar('tipe'),
			'lantai' => $this->request->getVar('lantai'),
			'kapasitas' => $this->request->getVar('kapasitas'),
			'ukuran' => $ukuran,
			'luas' => $luas,
			'fasilitas' => $this->request->getVar('fasilitas'),
			'biaya_sewa' => $this->request->getVar('biayasewa'),
		]);

		// delete gambar
		// delete di table galeri
		$fotoLama = $this->galeriRuanganModel->getGaleriByRuangan($id);
		if ($fotoLama) {
			foreach ($fotoLama as $key => $fl) {
				unlink('uploads/' . $fl['nama_file']);
				$this->galeriModel->delete($fl['id_galeri']);
				// $this->galeriRuanganModel->delete($galeriRuangan[$key]['id']);
			}
		}
		// delete di table galeri_ruangan
		$galeriRuangan = $this->galeriRuanganModel->findGaleriRuangan($id);
		if ($galeriRuangan) {
			foreach ($galeriRuangan as $gr) {
				$this->galeriRuanganModel->delete($gr['id']);
			}
		}

		// ambil gambar
		$fotoruangan = $this->request->getFileMultiple('fotoruangan');

		if ($fotoruangan) {
			foreach ($fotoruangan as $f) {
				if ($f->isValid() && !$f->hasMoved()) {
					// pindahin ke folder
					$f->move('uploads');
					// ambil nama foto
					$namafoto = $f->getName();
					// simpan ke database
					$this->galeriModel->save([
						'nama_file' => $namafoto,
					]);
					$this->galeriRuanganModel->save([
						'id_galeri' => $this->galeriModel->insertID(),
						'id_ruangan' => $id
					]);
				}
			}
		}

		// get slug
		$ruangan = $this->ruanganModel->getRuanganByID($id);
		$namaRuangan = $ruangan['slug'];

		session()->setFlashdata('sukses', 'Data berhasil diubah.');

		return redirect()->to('/DashboardAdmin/ruangan');
	}

	// delete ruangan
	public function deleteRuangan($id)
	{
		// delete gambar
		// delete di table galeri
		$fotoLama = $this->galeriRuanganModel->getGaleriByRuangan($id);
		if ($fotoLama) {
			foreach ($fotoLama as $key => $fl) {
				unlink('uploads/' . $fl['nama_file']);
				$this->galeriModel->delete($fl['id_galeri']);
				// $this->galeriRuanganModel->delete($galeriRuangan[$key]['id']);
			}
		}
		// delete di table galeri_ruangan
		$galeriRuangan = $this->galeriRuanganModel->findGaleriRuangan($id);
		if ($galeriRuangan) {
			foreach ($galeriRuangan as $gr) {
				$this->galeriRuanganModel->delete($gr['id']);
			}
		}

		// delete ruangan
		$this->ruanganModel->delete($id);

		session()->setFlashdata('sukses', 'Data berhasil dihapus.');

		return redirect()->to('/DashboardAdmin/ruangan');
	}

	// form tambah alat
	public function tambahAlat()
	{
		session();
		$this->data['current_page'] = 'adminalat';
		$this->data['admin'] = true;
		$this->data['judul_halaman'] = 'Tambah Alat';

		$this->viewAdmin('formtambahalat.php', $this->data);
	}

	// simpan tambah alat
	public function saveTambahAlat()
	{
		// aturan validasi
		$rules = $this->formRulesAlat('required|is_unique[alat.nama]');

		// cek validasi
		if (!$this->validate($rules)) {
			return redirect()->to('/DashboardAdmin/tambah-alat')->withInput();
		}

		// dd($this->request->getVar());
		// dd($this->request->getFileMultiple('fotoalat'));

		// simpan data tambah alat
		$this->alatModel->save([
			'nama' => $this->request->getVar('nama'),
			'slug' => url_title($this->request->getVar('nama'), '-', true),
			'deskripsi' => $this->request->getVar('deskripsiAlat'),
			'biaya_sewa' => $this->request->getVar('biayasewa'),
		]);

		$idalat = $this->alatModel->insertID();

		// ambil gambar
		$fotoalat = $this->request->getFileMultiple('fotoalat');

		if ($fotoalat) {
			foreach ($fotoalat as $f) {
				if ($f->isValid() && !$f->hasMoved()) {
					// pindahin ke folder
					$f->move('uploads');
					// ambil nama foto
					$namafoto = $f->getName();
					// simpan ke database
					$this->galeriModel->save([
						'nama_file' => $namafoto,
					]);
					$this->galeriAlatModel->save([
						'id_galeri' => $this->galeriModel->insertID(),
						'id_Alat' => $idalat
					]);
				}
			}
		}

		// get slug
		$alat = $this->alatModel->getAlatByID($idalat);
		$namaAlat = $alat['slug'];

		session()->setFlashdata('sukses', 'Data berhasil ditambahkan.');

		return redirect()->to('/DashboardAdmin/alat');
	}

	// form update alat
	public function updateAlat($slug)
	{
		$this->data['current_page'] = 'adminalat';
		$alat = $this->alatModel->getAlat($slug);
		session();

		$this->data['admin'] = true;
		$this->data['alat'] = $alat;
		// $this->data['judul_halaman'] = 'Tambah Ruangan';
		$this->data['fotoalat'] = $this->galeriAlatModel->getGaleriByAlat($alat['id']);

		$this->viewAdmin('formeditalat.php', $this->data);
	}

	// simpan update alat
	public function saveUpdateAlat($id)
	{
		$slugLama = $this->request->getVar('slug');

		($slugLama == url_title($this->request->getVar('nama'))) ? $rules_nama = 'required' : $rules_nama = 'required|is_unique[alat.nama]';

		// aturan validasi
		$rules = $this->formRulesAlat($rules_nama);

		// cek validasi
		if (!$this->validate($rules)) {
			return redirect()->to('/DashboardAdmin/update-alat')->withInput();
		}

		// dd($this->request->getVar());
		// dd($this->request->getFileMultiple('fotoruangan'));

		// simpan data update alat
		$this->alatModel->save([
			'id' => $id,
			'nama' => $this->request->getVar('nama'),
			'slug' => url_title($this->request->getVar('nama')),
			'deskripsi' => $this->request->getVar('deskripsiAlat'),
			'biaya_sewa' => $this->request->getVar('biayasewa'),
		]);

		// delete gambar
		// delete di table galeri
		$fotoLama = $this->galeriAlatModel->getGaleriByAlat($id);
		if ($fotoLama) {
			foreach ($fotoLama as $key => $fl) {
				unlink('uploads/' . $fl['nama_file']);
				$this->galeriModel->delete($fl['id_galeri']);
				// $this->galeriRuanganModel->delete($galeriRuangan[$key]['id']);
			}
		}
		// delete di table galeri_alat
		$galeriAlat = $this->galeriAlatModel->findGaleriAlat($id);
		if ($galeriAlat) {
			foreach ($galeriAlat as $ga) {
				$this->galeriAlatModel->delete($ga['id']);
			}
		}

		// ambil gambar
		$fotoalat = $this->request->getFileMultiple('fotoalat');

		if ($fotoalat) {
			foreach ($fotoalat as $f) {
				if ($f->isValid() && !$f->hasMoved()) {
					// pindahin ke folder
					$f->move('uploads');
					// ambil nama foto
					$namafoto = $f->getName();
					// simpan ke database
					$this->galeriModel->save([
						'nama_file' => $namafoto,
					]);
					$this->galeriAlatModel->save([
						'id_galeri' => $this->galeriModel->insertID(),
						'id_alat' => $id
					]);
				}
			}
		}

		// get slug
		$alat = $this->alatModel->getAlatByID($id);
		$namaAlat = $alat['slug'];

		session()->setFlashdata('sukses', 'Data berhasil diubah.');

		return redirect()->to('/DashboardAdmin/alat');
	}

	public function deleteAlat($id)
	{
		// delete gambar
		// delete di table galeri
		$fotoLama = $this->galeriAlatModel->getGaleriByAlat($id);
		if ($fotoLama) {
			foreach ($fotoLama as $key => $fl) {
				unlink('uploads/' . $fl['nama_file']);
				$this->galeriModel->delete($fl['id_galeri']);
				// $this->galeriRuanganModel->delete($galeriRuangan[$key]['id']);
			}
		}
		// delete di table galeri_alat
		$galeriAlat = $this->galeriAlatModel->findGaleriAlat($id);
		if ($galeriAlat) {
			foreach ($galeriAlat as $ga) {
				$this->galeriAlatModel->delete($ga['id']);
			}
		}

		// delete alat
		$this->alatModel->delete($id);

		session()->setFlashdata('sukses', 'Data berhasil dihapus.');

		return redirect()->to('/DashboardAdmin/alat');
	}

	// form tambah kegiatan
	public function tambahKegiatan()
	{
		$this->data['current_page'] = 'adminkegiatan';
		session();
		$this->data['admin'] = true;
		// $this->data['judul_halaman'] = 'Tambah kegiatan';

		$this->viewAdmin('formtambahkegiatan.php', $this->data);
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

		$this->viewAdmin('formeditkegiatan.php', $this->data);
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

	// form tambah artikel
	public function tambahRilisMedia()
	{
		$this->data['current_page'] = 'adminrilismedia';
		session();
		$this->data['admin'] = true;
		// $this->data['judul_halaman'] = 'Tambah kegiatan';

		$this->viewAdmin('formtambahartikel.php', $this->data);
	}

	// simpan tambah artikel
	public function saveTambahRilisMedia()
	{
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

		$this->viewAdmin('formeditartikel.php', $this->data);
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
			return redirect()->to('/DashboardAdmin/update-rilis-media')->withInput();
		}

		// dd($this->request->getFile('poster'));
		// ambil gambar
		$featured_image = $this->request->getFile('featured_image');
		// dd($featured_image);

		// delete gambar
		if ($artikelLama['featured_image']) {
			unlink('uploads/' . $artikelLama['featured_image']);
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
				unlink('uploads/' . $artikel['featured_image']);
			}
			$this->artikelModel->delete($id);
		}

		session()->setFlashdata('sukses', 'Data berhasil dihapus.');

		return redirect()->to('/DashboardAdmin/rilis-media');
	}

	// aturan validasi form ruangan
	public function formRulesRuangan($rules_nama)
	{
		$rules = [
			'nama' => [
				'rules' => $rules_nama,
				'errors' => [
					'required' => '{field} ruangan harus diisi',
					'is_unique' => '{field} ruangan sudah ada'
				]
			],
			'deskripsiRuangan' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'deskripsi ruangan harus diisi',
				]
			],
			'tipe' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'tipe ruangan harus diisi',
				]
			],
			'lantai' => [
				'rules' => 'required',
				'errors' => [
					'required' => '{field} harus diisi'
				]
			],
			'kapasitas' => [
				'rules' => 'required',
				'errors' => [
					'required' => '{field} harus diisi'
				]
			],
			'panjang' => [
				'rules' => 'required',
				'errors' => [
					'required' => '{field} ruangan harus dipilih'
				]
			],
			'lebar' => [
				'rules' => 'required',
				'errors' => [
					'required' => '{field} ruangan harus dipilih'
				]
			],
			'tinggi' => [
				'rules' => 'required',
				'errors' => [
					'required' => '{field} ruangan harus dipilih'
				]
			],
			'fotoruangan[]' => [
				'rules' => 'max_size[fotoruangan,2048]|is_image[fotoruangan]|mime_in[fotoruangan,image/jpg,image/jpeg,image/png]',
				'errors' => [
					'max_size' => 'ukuran foto ruangan maksimal 2MB',
					'is_image' => 'file yang Anda pilih bukan gambar',
					'mime_in' => 'file yang Anda pilih bukan gambar'
				]
			]
		];

		return $rules;
	}

	// aturan validasi form alat
	public function formRulesAlat($rules_nama)
	{
		$rules = [
			'nama' => [
				'rules' => $rules_nama,
				'errors' => [
					'required' => '{field} alat harus diisi',
					'is_unique' => '{field} alat sudah ada'
				]
			],
			'deskripsiAlat' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'deskripsi alat harus diisi',
				]
			],
			'fotoalat[]' => [
				'rules' => 'max_size[fotoalat,2048]|is_image[fotoalat]|mime_in[fotoalat,image/jpg,image/jpeg,image/png]',
				'errors' => [
					'max_size' => 'ukuran foto alat maksimal 2MB',
					'is_image' => 'file yang Anda pilih bukan gambar',
					'mime_in' => 'file yang Anda pilih bukan gambar'
				]
			]
		];

		return $rules;
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
				'rules' => 'max_size[featured_image,2048]|is_image[featured_image]|mime_in[featured_image,image/jpg,image/jpeg,image/png]',
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
