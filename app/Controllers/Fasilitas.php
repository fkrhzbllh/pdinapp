<?php

namespace App\Controllers;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use App\Models\RuanganModel;
use App\Models\AlatModel;
use App\Models\SewaRuanganModel;
use App\Models\SewaAlatModel;
use App\Models\PenyewaModel;
use App\Models\GaleriRuanganModel;
use App\Models\GaleriAlatModel;
use App\Models\RuanganTipeModel;

class Fasilitas extends BaseController
{
	protected $ruanganModel;
	protected $ruanganTipeModel;

	protected $alatModel;

	protected $sewaRuanganModel;

	protected $sewaAlatModel;

	protected $penyewaModel;

	protected $galeriRuanganModel;

	protected $galeriAlatModel;

	protected $helpers = ['form'];

	public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
	{
		parent::initController($request, $response, $logger);

		$this->ruanganModel = new RuanganModel();
		$this->ruanganTipeModel = new RuanganTipeModel();
		$this->alatModel = new AlatModel();
		$this->sewaRuanganModel = new SewaRuanganModel();
		$this->sewaAlatModel = new SewaAlatModel();
		$this->penyewaModel = new PenyewaModel();
		$this->galeriRuanganModel = new GaleriRuanganModel();
		$this->galeriAlatModel = new GaleriAlatModel();
		$this->data['judul_halaman'] = 'Fasilitas | Pusat Desain Industri Nasional';
		$this->data['current_page'] = 'fasilitas';
		$this->data['admin'] = false;

		$this->helpers = ['form'];
	}

	public function index()
	{
		$ruangan = $this->ruanganModel->getRuangan();
		$ruangan_tipe = $this->ruanganTipeModel->findAll();

		// Tipe ruangan
		$this->data['tipe_ruangan'] = $ruangan_tipe;

		// Ruangan yang ada fotonya
		$ruangan_berfoto = [];
		$foto_ruangan_berfoto = [];

		foreach ($ruangan as $key => $r) {
			$foto = $this->galeriRuanganModel->getGaleriByRuangan($r['id']);

			// Apakah foto ditemukan
			if ($foto) { // Jika foto ditemukan

				// Masukkan foto ke data foto_ruangan dengan key sama dengan ruangan
				$this->data['fotoruangan'][$key] = $foto[0];

				// Masukkan ruangan ke array ruangan_berfoto
				array_push($ruangan_berfoto, $r);
				// Masukkan juga foto ke array foto_ruangan_berfoto
				array_push($foto_ruangan_berfoto, $foto[0]);
			} else { // Jika foto tidak ditemukan

				// Masukkan null ke data foto_ruangan TODO: Ganti ke gambar placeholder
				$this->data['fotoruangan'][$key] = null;
			}
		}
		$this->data['ruangan'] = $ruangan; // Seluruh ruangan
		$this->data['ruangan_berfoto'] = $ruangan_berfoto; // Khusus ruangan yang berfoto
		$this->data['foto_ruangan_berfoto'] = $foto_ruangan_berfoto; // Khusus ruangan yang berfoto

		$alat = $this->alatModel->getAlat();
		foreach ($alat as $key => $a) {
			// $this->data['fotoalat'][$key] = $this->galeriAlatModel->where('id_alat', $a['id'])->first();
			$foto = $this->galeriAlatModel->getGaleriByAlat($a['id']);
			if ($foto) {
				$this->data['fotoalat'][$key] = $foto[0];
			} else {
				// $this->data['fotoalat'][$key]['nama_file'] = '...';
				$this->data['fotoalat'][$key] = null;
			}
		}
		$this->data['alat'] = $alat;

		return view('fasilitas.php', $this->data);
	}

	public function detailRuangan($slug)
	{
		$ruangan = $this->ruanganModel->getRuangan($slug);
		$jadwal = $this->sewaRuanganModel->getJadwalSewaRuangan($ruangan['id']);

		// tampilan error kalau tidak ada nama ruangan yang ada di database
		if (empty($ruangan)) {
			throw new \CodeIgniter\Exceptions\PageNotFoundException('Ruangan ' . $slug . ' tidak ditemukan.');
		}

		if ($this->galeriRuanganModel->getGaleriByRuangan($ruangan['id'])) {
			$fotoruangan = $this->galeriRuanganModel->getGaleriByRuangan($ruangan['id']);
		} else {
			$fotoruangan['nama_file'] = null;
		}

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

		return view('detailruangan.php', $this->data);
	}

	public function detailAlat($slug)
	{
		$alat = $this->alatModel->getAlat($slug);
		$jadwal = $this->sewaAlatModel->getJadwalSewaAlat($alat['id']);

		// tampilan error kalau tidak ada nama alat yang ada di database
		if (empty($alat)) {
			throw new \CodeIgniter\Exceptions\PageNotFoundException('Alat ' . $slug . ' tidak ditemukan.');
		}

		// menampilkan foto alat
		if ($this->galeriAlatModel->getGaleriByAlat($alat['id'])) {
			$fotoalat = $this->galeriAlatModel->getGaleriByAlat($alat['id']);
		} else {
			$fotoalat['nama_file'] = null;
		}

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

		return view('detailalat.php', $this->data);
	}

	// form sewa ruangan
	public function sewaRuangan($id = null)
	{
		session();
		$this->data['id_ruangan'] = $id;
		$this->data['judul_halaman'] = 'Sewa Ruangan PDIN';
		$this->data['ruangan'] = $this->ruanganModel->getRuangan();

		return view('sewaruangan.php', $this->data);
	}

	// form sewa alat
	public function sewaAlat($id = null)
	{
		session();
		$this->data['id_alat'] = $id;
		$this->data['judul_halaman'] = 'Sewa Alat PDIN';
		$this->data['alat'] = $this->alatModel->getAlat();

		return view('sewaalat.php', $this->data);
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
		$this->penyewaModel->save([
			'email' => $this->request->getVar('email'),
			'nama' => $this->request->getVar('nama'),
			'kontak' => $this->request->getVar('nomorTelepon'),
			'nama_instansi' => $this->request->getVar('instansi'),
		]);

		$userID = $this->penyewaModel->insertID();

		// simpan data sewa berdasarkan tipe
		if ($tipe == 'Pameran') {
			$this->sewaRuanganModel->save([
				'id_ruangan' => $idRuangan,
				'nama_kegiatan' => $this->request->getVar('namaKegiatan'),
				'deskripsi' => $this->request->getVar('deskripsiKegiatan'),
				'id_penyewa' => $userID,
				'tgl_mulai_sewa' => $this->request->getVar('tanggalMulaiPameran'),
				'tgl_akhir_sewa' => $this->request->getVar('tanggalSelesaiPameran'),
			]);
		} elseif ($tipe == 'Kantor') {
			$this->sewaRuanganModel->save([
				'id_ruangan' => $idRuangan,
				'nama_kegiatan' => $this->request->getVar('namaKegiatan'),
				'deskripsi' => $this->request->getVar('deskripsiKegiatan'),
				'id_penyewa' => $userID,
				'tgl_mulai_sewa' => $this->request->getVar('tanggalMulaiKantor'),
				'tgl_akhir_sewa' => $this->request->getVar('tanggalSelesaiKantor'),
			]);
		} elseif ($tipe == 'Meeting') {
			$this->sewaRuanganModel->save([
				'id_ruangan' => $idRuangan,
				'nama_kegiatan' => $this->request->getVar('namaKegiatan'),
				'deskripsi' => $this->request->getVar('deskripsiKegiatan'),
				'id_penyewa' => $userID,
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
		$this->penyewaModel->save([
			'email' => $this->request->getVar('email'),
			'nama' => $this->request->getVar('nama'),
			'kontak' => $this->request->getVar('nomorTelepon'),
			'nama_instansi' => $this->request->getVar('instansi'),
		]);

		$userID = $this->penyewaModel->insertID();

		// simpan data sewa
		$this->sewaAlatModel->save([
			'id_alat' => $idAlat,
			'nama_kegiatan' => $this->request->getVar('namaKegiatan'),
			// 'deskripsi' => $this->request->getVar('deskripsiKegiatan'),
			'id_penyewa' => $userID,
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
