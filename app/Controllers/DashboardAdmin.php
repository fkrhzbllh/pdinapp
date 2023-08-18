<?php

namespace App\Controllers;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use App\Models\RuanganModel;
use App\Models\AlatModel;
use App\Models\SewaRuanganModel;
use App\Models\SewaAlatModel;
use App\Models\UsersModel;
use App\Models\GaleriRuanganModel;
use App\Models\GaleriAlatModel;
use App\Models\GaleriModel;
use App\Models\ArtikelModel;
use App\Models\KegiatanModel;
use IntlDateFormatter;

class DashboardAdmin extends BaseController
{
	protected $ruanganModel;

	protected $alatModel;

	protected $sewaRuanganModel;

	protected $sewaAlatModel;

	protected $usersModel;

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
		$this->usersModel = new UsersModel();
		$this->galeriRuanganModel = new GaleriRuanganModel();
		$this->galeriAlatModel = new GaleriAlatModel();
		$this->galeriModel = new GaleriModel();
		$this->artikelModel = new ArtikelModel();
		$this->kegiatanModel = new KegiatanModel();
		$this->helpers = ['form'];
		$this->data['judul_halaman'] = 'Admin | Pusat Desain Industri Nasional';
		$this->data['current_page'] = 'adminrilismedia';
		$this->data['admin'] = true;
		date_default_timezone_set('Asia/Jakarta');
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
		// $namaRuangan = $ruangan['slug'];

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

	// list sewa suatu ruangan
	public function listSewaRuangan($slug)
	{
		$this->data['current_page'] = 'adminruangan';
		$ruangan = $this->ruanganModel->getRuangan($slug);

		// tampilan error kalau tidak ada nama ruangan yang ada di database
		if (empty($ruangan)) {
			throw new \CodeIgniter\Exceptions\PageNotFoundException('Ruangan "' . $slug . '" tidak ditemukan.');
		}
		// $this->data['id_ruangan'] = $id;
		$jadwal = $this->sewaRuanganModel->getJadwalSewaRuangan($ruangan['id']);
		// $penyewa = $this->usersModel->getUserByID($jadwal['id_user']);
		// $penyewa = $this->usersModel->findAll();
		$this->data['ruangan'] = $ruangan;
		$this->data['jadwal'] = $jadwal;
		// $this->data['penyewa'] = $penyewa;

		// menampilkan penyewa sewa ruangan
		if ($jadwal) {
			foreach ($jadwal as $key => $value) {
				$penyewa = $this->usersModel->getUserByID($value['id_user']);
				if ($penyewa == null || empty($penyewa)) {
					// dd($this->usersModel->getUserByID($jadwal[2]['id_user']));
					$this->data['penyewa'][$key]['nama'] = '';
					$this->data['penyewa'][$key]['kontak'] = '';
					$this->data['penyewa'][$key]['nama_instansi'] = '';
				} else {
					if ($ruangan['tipe'] == 'Pameran') {
						$this->data['events'][$key]['allDay'] = true;
						$this->data['events'][$key]['end'] = date_add(date_create($value['tgl_akhir_sewa']), date_interval_create_from_date_string('1 day'))->format('Y-m-d H:i:s');
					}
					$this->data['penyewa'][$key]['nama'] = $penyewa['nama'];
					$this->data['penyewa'][$key]['kontak'] = $penyewa['kontak'];
					$this->data['penyewa'][$key]['nama_instansi'] = $penyewa['nama_instansi'];
					$this->data['events'][$key]['title'] = $value['nama_kegiatan'];
					$this->data['events'][$key]['start'] = $value['tgl_mulai_sewa'];
					$this->data['events'][$key]['end'] = date_create($value['tgl_akhir_sewa'])->format('Y-m-d H:i:s');
					$this->data['events'][$key]['selesai'] = date_create($value['tgl_akhir_sewa'])->format('Y-m-d H:i:s');
					$this->data['events'][$key]['nama'] = $penyewa['nama'];
					$this->data['events'][$key]['kontak'] = $penyewa['kontak'];
					$this->data['events'][$key]['email'] = $penyewa['email'];
					$this->data['events'][$key]['nama_instansi'] = $penyewa['nama_instansi'];
					$this->data['events'][$key]['deskripsi'] = $value['deskripsi'];
					$this->data['events'][$key]['tipe_ruangan'] = $ruangan['tipe'];
				}
			}
		} else {
			$this->data['penyewa'] = '';
			$this->data['events'] = '';
		}

		$this->data['judul_halaman'] = 'Sewa ' . $ruangan['nama'];

		$this->viewAdmin('adminsewaruangan.php', $this->data);
	}

	// form sewa ruangan
	public function tambahSewaRuangan($slug = null)
	{
		session();
		$ruangan = $this->ruanganModel->getRuangan($slug);

		// tampilan error kalau tidak ada nama ruangan yang ada di database
		if (empty($ruangan)) {
			throw new \CodeIgniter\Exceptions\PageNotFoundException('Ruangan "' . $slug . '" tidak ditemukan.');
		}

		$this->data['current_page'] = 'adminruangan';
		$this->data['id_ruangan'] = $ruangan['id'];
		$this->data['judul_halaman'] = 'Sewa Ruangan PDIN';
		$this->data['ruangan'] = $this->ruanganModel->getRuangan(); // find all

		$this->viewAdmin('formtambahsewaruangan.php', $this->data);
	}

	// form sewa alat
	public function tambahSewaAlat($slug = null)
	{
		session();
		$alat = $this->alatModel->getAlat($slug);
		$this->data['current_page'] = 'adminalat';
		$this->data['id_alat'] = $alat['id'];
		$this->data['judul_halaman'] = 'Sewa Alat PDIN';
		$this->data['alat'] = $this->alatModel->getAlat(); // find all

		$this->viewAdmin('sewaalat.php', $this->data);
	}

	// simpan data sewa ruangan
	public function saveTambahSewaRuangan()
	{
		$tipe = $this->request->getVar('tipe');
		$idRuangan = $this->request->getVar('ruangan');
		$ruangan = $this->ruanganModel->getRuanganByID($idRuangan);
		$slug = $ruangan['slug'];

		// $mulai = $this->request->getVar('tanggalMulaiPameran');
		// $selesai = $this->request->getVar('tanggalSelesaiPameran');
		// $formatter = new IntlDateFormatter('id_ID', IntlDateFormatter::SHORT, IntlDateFormatter::FULL, null, null);
		// $aaaaaa = $formatter->format(date_create($mulai));
		// $aaaaaa = date_create($mulai);
		// $bbbbbb = date_add(date_create($selesai), date_interval_create_from_date_string('23 hours + 59 mins + 59 secs'));
		// d($aaaaaa);
		// dd($bbbbbb);

		// aturan validasi
		$rules = $this->formRulesSewaRuangan($tipe);

		// cek validasi
		if (!$this->validate($rules)) {
			return redirect()->to('/DashboardAdmin/tambah-sewa-ruangan/' . $slug)->withInput();
		}

		// dd($this->request->getVar());

		// simpan data user
		$this->usersModel->save([
			'email' => $this->request->getVar('email'),
			'nama' => $this->request->getVar('nama'),
			'kontak' => $this->request->getVar('nomorTelepon'),
			'nama_instansi' => $this->request->getVar('instansi'),
		]);

		$userID = $this->usersModel->insertID();

		// simpan data sewa berdasarkan tipe
		if ($tipe == 'Pameran') {
			// $mulai = date_create($this->request->getVar('tanggalMulaiPameran'));
			// $mulai = $this->request->getVar('tanggalMulaiPameran');
			// $selesai = date_add(date_create($this->request->getVar('tanggalSelesaiPameran')), date_interval_create_from_date_string('23 hours + 59 mins + 59 secs'));
			// $selesai = date_create($this->request->getVar('tanggalSelesaiPameran'));
			// $selesai = $this->request->getVar('tanggalSelesaiPameran');
			// dd($selesai);
			$this->sewaRuanganModel->save([
				'id_ruangan' => $idRuangan,
				'nama_kegiatan' => $this->request->getVar('namaKegiatan'),
				'deskripsi' => $this->request->getVar('deskripsiKegiatan'),
				'id_user' => $userID,
				'tgl_mulai_sewa' => $this->request->getVar('tanggalMulaiPameran'),
				'tgl_akhir_sewa' => $this->request->getVar('tanggalSelesaiPameran'),
				// 'tgl_mulai_sewa' => $mulai,
				// 'tgl_akhir_sewa' => $selesai->format('Y-m-d H:i:s'),
				// 'tgl_akhir_sewa' => $selesai,
			]);
		} elseif ($tipe == 'Kantor') {
			$this->sewaRuanganModel->save([
				'id_ruangan' => $idRuangan,
				'nama_kegiatan' => $this->request->getVar('namaKegiatan'),
				'deskripsi' => $this->request->getVar('deskripsiKegiatan'),
				'id_user' => $userID,
				'tgl_mulai_sewa' => $this->request->getVar('tanggalMulaiKantor'),
				'tgl_akhir_sewa' => $this->request->getVar('tanggalSelesaiKantor'),
			]);
		} elseif ($tipe == 'Meeting') {
			$this->sewaRuanganModel->save([
				'id_ruangan' => $idRuangan,
				'nama_kegiatan' => $this->request->getVar('namaKegiatan'),
				'deskripsi' => $this->request->getVar('deskripsiKegiatan'),
				'id_user' => $userID,
				'tgl_mulai_sewa' => $this->request->getVar('tanggalMulaiMeeting'),
				'tgl_akhir_sewa' => $this->request->getVar('tanggalSelesaiMeeting'),
			]);
		} elseif ($tipe == 'Pengembangan') {
			$this->sewaRuanganModel->save([
				'id_ruangan' => $idRuangan,
				'nama_kegiatan' => $this->request->getVar('namaKegiatan'),
				'deskripsi' => $this->request->getVar('deskripsiKegiatan'),
				'id_user' => $userID,
				'tgl_mulai_sewa' => $this->request->getVar('tanggalMulaiPengembangan'),
				'tgl_akhir_sewa' => $this->request->getVar('tanggalSelesaiPengembangan'),
			]);
		}

		// get slug
		// $ruangan = $this->ruanganModel->getRuanganByID($idRuangan);
		// $namaRuangan = $ruangan['slug'];

		session()->setFlashdata('sukses', 'Data berhasil ditambahkan.');

		return redirect()->to('/DashboardAdmin/sewa-ruangan/' . $slug);
	}

	// simpan data sewa alat
	public function saveTambahSewaAlat()
	{
		$idAlat = $this->request->getVar('alat');

		// aturan validasi
		$rules = $this->formRulesSewaAlat();

		// cek validasi
		if (!$this->validate($rules)) {
			return redirect()->to('/DashboardAdmin/sewaAlat')->withInput();
		}

		// dd($this->request->getVar());

		// simpan data user
		$this->usersModel->save([
			'email' => $this->request->getVar('email'),
			'nama' => $this->request->getVar('nama'),
			'kontak' => $this->request->getVar('nomorTelepon'),
			'nama_instansi' => $this->request->getVar('instansi'),
		]);

		$userID = $this->usersModel->insertID();

		// simpan data sewa
		$this->sewaAlatModel->save([
			'id_alat' => $idAlat,
			'nama_kegiatan' => $this->request->getVar('namaKegiatan'),
			// 'deskripsi' => $this->request->getVar('deskripsiKegiatan'),
			'id_user' => $userID,
			'tgl_mulai_sewa' => $this->request->getVar('tanggalMulai'),
			'tgl_akhir_sewa' => $this->request->getVar('tanggalSelesai'),
		]);

		// get slug
		// $alat = $this->alatModel->getAlatByID($idAlat);
		// $namaAlat = $alat['slug'];

		session()->setFlashdata('sukses', 'Data berhasil ditambahkan.');

		return redirect()->to('/DashboardAdmin/alat');
	}

	// form edit sewa ruangan
	public function updateSewaRuangan()
	{
		$this->data['current_page'] = 'adminruangan';
		$this->data['judul_halaman'] = 'Sewa Ruangan PDIN';

		if (session()->getFlashdata('Jadwal')) {
			$id = session()->getFlashdata('Jadwal');
		} else {
			$id = $this->request->getVar('id');
		}

		// if ($id) {
		// ambil data jadwal yang dipilih
		$jadwal = $this->sewaRuanganModel->getJadwalByID($id);
		$this->data['jadwal'] = $jadwal;

		// ambil data ruangan berdasarkan jadwal
		// $ruangan = $this->ruanganModel->getRuangan($slug);
		$ruangan = $this->ruanganModel->getRuanganByID($jadwal['id_ruangan']);
		$this->data['ruangan'] = $ruangan;
		$this->data['id_ruangan'] = $jadwal['id_ruangan'];

		// ambil data penyewa berdasarkan jadwal
		$penyewa = $this->usersModel->getUserByID($jadwal['id_user']);
		$this->data['penyewa'] = $penyewa;
		// } else {
		// d($this->request->getVar('idJadwal'));
		// d($this->request->getVar('idPenyewa'));
		// d($this->request->getVar('idRuangan'));
		// $this->data['jadwal']['id'] = '';
		// $this->data['jadwal']['nama_kegiatan'] = '';
		// $this->data['jadwal']['deskripsi'] = '';
		// $this->data['jadwal']['tgl_mulai_sewa'] = '';
		// $this->data['jadwal']['tgl_akhir_sewa'] = '';
		// $this->data['jadwal']['deskripsi'] = '';
		// $this->data['ruangan']['nama'] = '';
		// $this->data['ruangan']['id'] = '';
		// $this->data['ruangan']['tipe'] = '';
		// $this->data['id_ruangan'] = '';
		// $this->data['penyewa']['id'] = '';
		// $this->data['penyewa']['nama'] = '';
		// $this->data['penyewa']['email'] = '';
		// $this->data['penyewa']['kontak'] = '';
		// $this->data['penyewa']['nama_instansi'] = '';
		// }

		$this->viewAdmin('formeditsewaruangan.php', $this->data);
	}

	// update data sewa ruangan
	public function saveUpdateSewaRuangan($idJadwal, $idPenyewa)
	{
		$tipe = $this->request->getVar('tipe');
		$idRuangan = $this->request->getVar('ruangan');
		$ruangan = $this->ruanganModel->getRuanganByID($idRuangan);
		$slug = $ruangan['slug'];

		// aturan validasi
		$rules = $this->formRulesSewaRuangan($tipe);

		// cek validasi
		if (!$this->validate($rules)) {
			// return redirect()->to('/DashboardAdmin/update-sewa-ruangan/' . $slug)->withInput();
			session()->setFlashdata('Jadwal', $idJadwal);

			return redirect()->to('/DashboardAdmin/update-sewa-ruangan')->withInput();
		}

		// dd($this->request->getVar());

		// simpan data user
		$this->usersModel->save([
			'id' => $idPenyewa,
			'email' => $this->request->getVar('email'),
			'nama' => $this->request->getVar('nama'),
			'kontak' => $this->request->getVar('nomorTelepon'),
			'nama_instansi' => $this->request->getVar('instansi'),
		]);

		// simpan data sewa berdasarkan tipe
		if ($tipe == 'Pameran') {
			$this->sewaRuanganModel->save([
				'id' => $idJadwal,
				'id_ruangan' => $idRuangan,
				'nama_kegiatan' => $this->request->getVar('namaKegiatan'),
				'deskripsi' => $this->request->getVar('deskripsiKegiatan'),
				'id_user' => $idPenyewa,
				'tgl_mulai_sewa' => $this->request->getVar('tanggalMulaiPameran'),
				'tgl_akhir_sewa' => $this->request->getVar('tanggalSelesaiPameran'),
			]);
		} elseif ($tipe == 'Kantor') {
			date_default_timezone_set('Asia/Jakarta');
			$this->sewaRuanganModel->save([
				'id' => $idJadwal,
				'id_ruangan' => $idRuangan,
				'nama_kegiatan' => $this->request->getVar('namaKegiatan'),
				'deskripsi' => $this->request->getVar('deskripsiKegiatan'),
				'id_user' => $idPenyewa,
				'tgl_mulai_sewa' => $this->request->getVar('tanggalMulaiKantor'),
				'tgl_akhir_sewa' => $this->request->getVar('tanggalSelesaiKantor'),
			]);
		} elseif ($tipe == 'Meeting') {
			$this->sewaRuanganModel->save([
				'id' => $idJadwal,
				'id_ruangan' => $idRuangan,
				'nama_kegiatan' => $this->request->getVar('namaKegiatan'),
				'deskripsi' => $this->request->getVar('deskripsiKegiatan'),
				'id_user' => $idPenyewa,
				'tgl_mulai_sewa' => $this->request->getVar('tanggalMulaiMeeting'),
				'tgl_akhir_sewa' => $this->request->getVar('tanggalSelesaiMeeting'),
			]);
		} elseif ($tipe == 'Pengembangan') {
			$this->sewaRuanganModel->save([
				'id' => $idJadwal,
				'id_ruangan' => $idRuangan,
				'nama_kegiatan' => $this->request->getVar('namaKegiatan'),
				'deskripsi' => $this->request->getVar('deskripsiKegiatan'),
				'id_user' => $idPenyewa,
				'tgl_mulai_sewa' => $this->request->getVar('tanggalMulaiPengembangan'),
				'tgl_akhir_sewa' => $this->request->getVar('tanggalSelesaiPengembangan'),
			]);
		}

		// get slug
		// $ruangan = $this->ruanganModel->getRuanganByID($idRuangan);
		// $namaRuangan = $ruangan['slug'];

		session()->setFlashdata('sukses', 'Data berhasil diubah.');

		return redirect()->to('/DashboardAdmin/sewa-ruangan/' . $slug);
	}

	// hapus sewa ruangan
	public function deleteSewaRuangan($id)
	{
		$sewaruangan = $this->sewaRuanganModel->getJadwalByID($id);
		$ruangan = $this->ruanganModel->getRuanganByID($sewaruangan['id_ruangan']);
		$slug = $ruangan['slug'];

		if ($sewaruangan) {
			$this->sewaRuanganModel->delete($id);
			session()->setFlashdata('sukses', 'Data berhasil dihapus.');

			return redirect()->to('/DashboardAdmin/sewa-ruangan/' . $slug);
		} else {
			session()->setFlashdata('gagal', 'Data gagal dihapus.');

			return redirect()->to('/DashboardAdmin/sewa-ruangan/' . $slug);
		}
	}

	// form edit sewa alat
	public function updateSewaAlat()
	{
		$this->data['current_page'] = 'adminalat';
		$this->data['judul_halaman'] = 'Sewa Alat PDIN';
		$id = $this->request->getVar('id');

		// ambil data jadwal yang dipilih
		$jadwal = $this->sewaAlatModel->getJadwalByID($id);
		$this->data['jadwal'] = $jadwal;

		// ambil data alat berdasarkan jadwal
		// $alat = $this->alatModel->getalat($slug);
		$alat = $this->alatModel->getAlatByID($jadwal['id_alat']);
		$this->data['alat'] = $alat;
		$this->data['id_alat'] = $jadwal['id_alat'];

		// ambil data penyewa berdasarkan jadwal
		$penyewa = $this->usersModel->getUserByID($jadwal['id_user']);
		$this->data['penyewa'] = $penyewa;

		$this->viewAdmin('formeditsewaalat.php', $this->data);
	}

	// update data sewa alat
	public function saveUpdateSewaAlat($idJadwal, $idPenyewa)
	{
		// $tipe = $this->request->getVar('tipe');
		$idAlat = $this->request->getVar('alat');
		$alat = $this->alatModel->getAlatByID($idAlat);
		$slug = $alat['slug'];

		// aturan validasi
		$rules = $this->formRulesSewaAlat();

		// cek validasi
		if (!$this->validate($rules)) {
			// return redirect()->to('/DashboardAdmin/update-sewa-alat/' . $slug)->withInput();
			return redirect()->to('/DashboardAdmin/update-sewa-alat/')->withInput();
		}

		// dd($this->request->getVar());

		// simpan data user
		$this->usersModel->save([
			'id' => $idPenyewa,
			'email' => $this->request->getVar('email'),
			'nama' => $this->request->getVar('nama'),
			'kontak' => $this->request->getVar('nomorTelepon'),
			'nama_instansi' => $this->request->getVar('instansi'),
		]);

		// simpan data sewa
		$this->sewaAlatModel->save([
			'id' => $idJadwal,
			'id_alat' => $idAlat,
			'nama_kegiatan' => $this->request->getVar('namaKegiatan'),
			'deskripsi' => $this->request->getVar('deskripsiKegiatan'),
			'id_user' => $idPenyewa,
			'tgl_mulai_sewa' => $this->request->getVar('tanggalMulai'),
			'tgl_akhir_sewa' => $this->request->getVar('tanggalSelesai'),
		]);

		// get slug
		// $ruangan = $this->ruanganModel->getRuanganByID($idRuangan);
		// $namaRuangan = $ruangan['slug'];

		session()->setFlashdata('sukses', 'Data berhasil diubah.');

		return redirect()->to('/DashboardAdmin/sewa-alat/' . $slug);
	}

	// hapus sewa alat
	public function deleteSewaAlat($id)
	{
		$sewaalat = $this->sewaAlatModel->getJadwalByID($id);
		$alat = $this->alatModel->getAlatByID($sewaalat['id_alat']);
		$slug = $alat['slug'];

		if ($sewaalat) {
			$this->sewaAlatModel->delete($id);
			session()->setFlashdata('sukses', 'Data berhasil dihapus.');

			return redirect()->to('/DashboardAdmin/sewa-alat/' . $slug);
		} else {
			session()->setFlashdata('gagal', 'Data gagal dihapus.');

			return redirect()->to('/DashboardAdmin/sewa-alat/' . $slug);
		}
	}

	// aturan validasi form sewa ruangan
	public function formRulesSewaRuangan($tipe)
	{
		$date_rules = [];
		if ($tipe == 'Pameran') {
			$date_rules = [
				'tanggalMulaiPameran' => [
					'rules' => 'required|valid_date',
					'errors' => [
						'required' => 'tanggal mulai harus diisi',
						'valid_date' => 'tanggal mulai harus valid'
					]
				],
				'tanggalSelesaiPameran' => [
					'rules' => 'required|valid_date',
					'errors' => [
						'required' => 'tanggal selesai harus diisi',
						'valid_date' => 'tanggal selesai harus valid'
					]
				]
			];
		} elseif ($tipe == 'Kantor') {
			$date_rules = [
				'tanggalMulaiKantor' => [
					'rules' => 'required|valid_date',
					'errors' => [
						'required' => 'tanggal mulai harus diisi',
						'valid_date' => 'tanggal mulai harus valid'
					]
				],
				'tanggalSelesaiKantor' => [
					'rules' => 'required|valid_date',
					'errors' => [
						'required' => 'tanggal selesai harus diisi',
						'valid_date' => 'tanggal selesai harus valid'
					]
				]
			];
		} elseif ($tipe == 'Meeting') {
			$date_rules = [
				'tanggalMulaiMeeting' => [
					'rules' => 'required|valid_date',
					'errors' => [
						'required' => 'tanggal mulai harus diisi',
						'valid_date' => 'tanggal mulai harus valid'
					]
				],
				'tanggalSelesaiMeeting' => [
					'rules' => 'required|valid_date',
					'errors' => [
						'required' => 'tanggal selesai harus diisi',
						'valid_date' => 'tanggal selesai harus valid'
					]
				]
			];
		} elseif ($tipe == 'Pengembangan') {
			$date_rules = [
				'tanggalMulaiPengembangan' => [
					'rules' => 'required|valid_date',
					'errors' => [
						'required' => 'tanggal mulai harus diisi',
						'valid_date' => 'tanggal mulai harus valid'
					]
				],
				'tanggalSelesaiPengembangan' => [
					'rules' => 'required|valid_date',
					'errors' => [
						'required' => 'tanggal selesai harus diisi',
						'valid_date' => 'tanggal selesai harus valid'
					]
				]
			];
		}

		$rules = [
			'nama' => [
				'rules' => 'required',
				'errors' => [
					'required' => '{field} harus diisi'
				]
			],
			'email' => [
				'rules' => 'required|valid_email',
				'errors' => [
					'required' => '{field} harus diisi',
					'valid_email' => '{field} harus valid'
				]
			],
			'nomorTelepon' => [
				'rules' => 'required|numeric|min_length[8]|max_length[15]',
				'errors' => [
					'required' => 'nomor telepon harus diisi',
					'numeric' => 'nomor telepon harus berupa angka',
					'min_length' => 'nomor telepon harus lebih dari 8 angka',
					'max_length' => 'nomor telepon harus kurang dari 15 angka'
				]
			],
			'instansi' => [
				'rules' => 'required',
				'errors' => [
					'required' => '{field} harus diisi'
				]
			],
			'namaKegiatan' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'nama kegiatan harus diisi'
				]
			],
			'deskripsiKegiatan' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'deskripsi kegiatan harus diisi'
				]
			],
			'ruangan' => [
				'rules' => 'required',
				'errors' => [
					'required' => '{field} harus dipilih'
				]
			],
		];

		return array_merge($rules, $date_rules);
	}

	// aturan validasi form sewa ruangan
	public function formRulesSewaAlat()
	{
		$rules = [
			'nama' => [
				'rules' => 'required',
				'errors' => [
					'required' => '{field} harus diisi'
				]
			],
			'email' => [
				'rules' => 'required|valid_email',
				'errors' => [
					'required' => '{field} harus diisi',
					'valid_email' => '{field} harus valid'
				]
			],
			'nomorTelepon' => [
				'rules' => 'required|numeric|min_length[8]|max_length[15]',
				'errors' => [
					'required' => 'nomor telepon harus diisi',
					'numeric' => 'nomor telepon harus berupa angka',
					'min_length' => 'nomor telepon harus lebih dari 8 angka',
					'max_length' => 'nomor telepon harus kurang dari 15 angka'
				]
			],
			'instansi' => [
				'rules' => 'required',
				'errors' => [
					'required' => '{field} harus diisi'
				]
			],
			'namaKegiatan' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'nama kegiatan harus diisi'
				]
			],
			'alat' => [
				'rules' => 'required',
				'errors' => [
					'required' => '{field} harus dipilih'
				]
			],
			'tanggalMulai' => [
				'rules' => 'required|valid_date',
				'errors' => [
					'required' => 'waktu mulai harus diisi',
					'valid_date' => 'waktu mulai harus valid'
				]
			],
			'tanggalSelesai' => [
				'rules' => 'required|valid_date',
				'errors' => [
					'required' => 'waktu selesai harus diisi',
					'valid_date' => 'waktu selesai harus valid'
				]
			]
		];

		return $rules;
	}
}
