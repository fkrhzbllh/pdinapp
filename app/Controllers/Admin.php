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

class Admin extends BaseController
{
	protected $ruanganModel;

	protected $alatModel;

	protected $sewaRuanganModel;

	protected $sewaAlatModel;

	protected $userModel;

	protected $galeriRuanganModel;

	protected $galeriAlatModel;

	protected $galeriModel;

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
		$this->helpers = ['form'];
		$this->data['judul_halaman'] = 'Admin | Pusat Desain Industri Nasional';
		$this->data['current_page'] = 'fasilitas';
		$this->data['admin'] = true;
	}

	public function index()
	{
		$ruangan = $this->ruanganModel->getRuangan();

		foreach ($ruangan as $key => $r) {
			// $this->data['fotoruangan'][$key] = $this->galeriRuanganModel->where('id_ruangan', $r['id'])->first();
			$foto = $this->galeriRuanganModel->getGaleriByRuangan($r['id']);
			if ($foto) {
				$this->data['fotoruangan'][$key] = $foto[0];
			} else {
				$this->data['fotoruangan'][$key]['nama_file'] = 'Logo-PDIN.png';
			}
		}
		$this->data['ruangan'] = $ruangan;

		$alat = $this->alatModel->getAlat();
		foreach ($alat as $key => $a) {
			$this->data['fotoalat'][$key] = $this->galeriAlatModel->where('id_alat', $a['id'])->first();
		}
		$this->data['alat'] = $alat;

		$this->data['judul_halaman'] = 'Fasilitas PDIN';

		$this->view('fasilitas.php', $this->data);
	}

	public function detailRuangan($slug)
	{
		$this->data['admin'] = true;
		$ruangan = $this->ruanganModel->getRuangan($slug);

		// tampilan error kalau tidak ada nama ruangan yang ada di database
		if (empty($ruangan)) {
			throw new \CodeIgniter\Exceptions\PageNotFoundException('Ruangan ' . $slug . ' tidak ditemukan.');
		}

		if ($this->galeriRuanganModel->getGaleriByRuangan($ruangan['id'])) {
			$fotoruangan = $this->galeriRuanganModel->getGaleriByRuangan($ruangan['id']);
		} else {
			$fotoruangan['nama_file'] = '...';
		}

		// dd($fotoruangan);

		$jadwal = $this->sewaRuanganModel->getJadwalSewaRuangan($ruangan['id']);

		// menampilkan jadwal sewa ruangan
		if ($jadwal) {
			foreach ($jadwal as $key => $value) {
				$this->data['jadwal_sewa'][$key]['title'] = $value['nama_kegiatan'];
				$this->data['jadwal_sewa'][$key]['start'] = $value['tgl_mulai_sewa'];
				$this->data['jadwal_sewa'][$key]['end'] = $value['tgl_akhir_sewa'];
				$this->data['jadwal_sewa'][$key]['backgroundColor'] = '#00a65a';
			}
		} else {
			$this->data['jadwal_sewa'] = '';
		}

		$this->data['ruangan'] = $ruangan;
		$this->data['judul_halaman'] = 'Detail Ruangan';
		$this->data['fotoruangan'] = $fotoruangan;

		$this->view('detailruangan.php', $this->data);
	}

	public function detailAlat($slug)
	{
		$this->data['admin'] = true;
		$alat = $this->alatModel->getAlat($slug);

		// tampilan error kalau tidak ada nama alat yang ada di database
		if (empty($alat)) {
			throw new \CodeIgniter\Exceptions\PageNotFoundException('Alat ' . $slug . ' tidak ditemukan.');
		}

		if ($this->galeriAlatModel->getGaleriByAlat($alat['id'])) {
			$fotoalat = $this->galeriAlatModel->getGaleriByAlat($alat['id']);
		} else {
			$fotoalat['nama_file'] = '...';
		}

		// dd($fotoalat);

		$jadwal = $this->sewaAlatModel->getJadwalSewaAlat($alat['id']);

		// menampilkan jadwal sewa alat
		if ($jadwal) {
			foreach ($jadwal as $key => $value) {
				$this->data['jadwal_sewa'][$key]['title'] = $value['nama_kegiatan'];
				$this->data['jadwal_sewa'][$key]['start'] = $value['tgl_mulai_sewa'];
				$this->data['jadwal_sewa'][$key]['end'] = $value['tgl_akhir_sewa'];
				$this->data['jadwal_sewa'][$key]['backgroundColor'] = '#00a65a';
			}
		} else {
			$this->data['jadwal_sewa'] = '';
		}

		$this->data['alat'] = $alat;
		$this->data['judul_halaman'] = 'Detail Alat';
		$this->data['fotoalat'] = $fotoalat;

		$this->view('detailalat.php', $this->data);
	}

	// form tambah ruangan
	public function tambahRuangan()
	{
		session();
		$this->data['admin'] = true;
		// $this->data['judul_halaman'] = 'Tambah Ruangan';

		$this->view('formtambahruangan.php', $this->data);
	}

	// simpan tambah ruangan
	public function saveTambahRuangan()
	{
		// aturan validasi
		$rules = $this->formRulesRuangan('required|is_unique[ruangan.nama]');

		// cek validasi
		if (!$this->validate($rules)) {
			return redirect()->to('/admin/tambahRuangan')->withInput();
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
			'slug' => urlencode($this->request->getVar('nama')),
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

		return redirect()->to('/admin/ruang/' . $namaRuangan);
	}

	// form update ruangan
	public function updateruangan($slug)
	{
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

		$this->view('formeditruangan.php', $this->data);
	}

	// simpan tambah ruangan
	public function saveUpdateRuangan($id)
	{
		$slugLama = $this->request->getVar('slug');

		($slugLama == url_title($this->request->getVar('nama'))) ? $rules_nama = 'required' : $rules_nama = 'required|is_unique[ruangan.nama]';

		// aturan validasi
		$rules = $this->formRulesRuangan($rules_nama);

		// cek validasi
		if (!$this->validate($rules)) {
			return redirect()->to('/admin/updateRuangan')->withInput();
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

		return redirect()->to('/admin/ruang/' . $namaRuangan);
	}

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

		return redirect()->to('/admin');
	}

	// form tambah alat
	public function tambahAlat()
	{
		session();
		$this->data['admin'] = true;
		$this->data['judul_halaman'] = 'Tambah Alat';

		$this->view('formalat.php', $this->data);
	}

	// simpan tambah alat
	public function saveTambahAlat()
	{
		// aturan validasi
		$rules = $this->formRulesAlat();

		// cek validasi
		if (!$this->validate($rules)) {
			return redirect()->to('/admin/tambahAlat')->withInput();
		}

		// dd($this->request->getVar());
		// dd($this->request->getFileMultiple('fotoalat'));

		// simpan data tambah ruangan
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
				// pindahin ke folder
				$f->move('uploads');
				// ambil nama foto
				$namafoto = $f->getName();
				// simpan ke database
				$this->galeriAlatModel->save([
					'nama_file' => $namafoto,
					'id_alat' => $idalat
				]);
			}
		}

		// get slug
		$alat = $this->alatModel->getAlatByID($idalat);
		$namaAlat = $alat['slug'];

		session()->setFlashdata('sukses', 'Data berhasil ditambahkan.');

		return redirect()->to('/admin/detailalat/' . $namaAlat);
	}

	// form sewa ruangan
	public function sewaRuangan($id = null)
	{
		session();
		$this->data['id_ruangan'] = $id;
		$this->data['judul_halaman'] = 'Sewa Ruangan PDIN';
		$this->data['ruangan'] = $this->ruanganModel->getRuangan();

		$this->view('sewaruangan.php', $this->data);
	}

	// form sewa alat
	public function sewaAlat($id = null)
	{
		session();
		$this->data['id_alat'] = $id;
		$this->data['judul_halaman'] = 'Sewa Alat PDIN';
		$this->data['alat'] = $this->alatModel->getAlat();

		$this->view('sewaalat.php', $this->data);
	}

	// simpan data sewa ruangan
	public function saveSewaRuangan()
	{
		$tipe = $this->request->getVar('tipe');
		$idRuangan = $this->request->getVar('ruangan');

		// aturan validasi
		$rules = $this->formRulesSewaRuangan($tipe);

		// cek validasi
		if (!$this->validate($rules)) {
			return redirect()->to('/fasilitas/sewaRuangan')->withInput();
		}

		// dd($this->request->getVar());

		// simpan data user
		$this->userModel->save([
			'email' => $this->request->getVar('email'),
			'nama' => $this->request->getVar('nama'),
			'kontak' => $this->request->getVar('nomorTelepon'),
			'nama_instansi' => $this->request->getVar('instansi'),
		]);

		$userID = $this->userModel->insertID();

		// simpan data sewa berdasarkan tipe
		if ($tipe == 'Pameran') {
			$this->sewaRuanganModel->save([
				'id_ruangan' => $idRuangan,
				'nama_kegiatan' => $this->request->getVar('namaKegiatan'),
				'deskripsi' => $this->request->getVar('deskripsiKegiatan'),
				'id_user' => $userID,
				'tgl_mulai_sewa' => $this->request->getVar('tanggalMulaiPameran'),
				'tgl_akhir_sewa' => $this->request->getVar('tanggalSelesaiPameran'),
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
		}

		// get slug
		$ruangan = $this->ruanganModel->getRuanganByID($idRuangan);
		$namaRuangan = $ruangan['slug'];

		session()->setFlashdata('sukses', 'Data berhasil ditambahkan.');

		return redirect()->to('/fasilitas/ruang/' . $namaRuangan);
	}

	// simpan data sewa alat
	public function saveSewaAlat()
	{
		$idAlat = $this->request->getVar('alat');

		// aturan validasi
		$rules = $this->formRulesSewaAlat();

		// cek validasi
		if (!$this->validate($rules)) {
			return redirect()->to('/fasilitas/sewaAlat')->withInput();
		}

		// dd($this->request->getVar());

		// simpan data user
		$this->userModel->save([
			'email' => $this->request->getVar('email'),
			'nama' => $this->request->getVar('nama'),
			'kontak' => $this->request->getVar('nomorTelepon'),
			'nama_instansi' => $this->request->getVar('instansi'),
		]);

		$userID = $this->userModel->insertID();

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
		$alat = $this->alatModel->getAlatByID($idAlat);
		$namaAlat = $alat['slug'];

		session()->setFlashdata('sukses', 'Data berhasil ditambahkan.');

		return redirect()->to('/fasilitas/alat/' . $namaAlat);
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

	// aturan validasi form ruangan
	public function formRulesAlat()
	{
		$rules = [
			'nama' => [
				'rules' => 'required|is_unique[alat.nama]',
				'errors' => [
					'required' => '{field} ruangan harus diisi',
					'is_unique' => '{field} ruangan sudah ada'
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
}
