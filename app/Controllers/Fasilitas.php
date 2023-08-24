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

class Fasilitas extends BaseController
{
	protected $ruanganModel;

	protected $alatModel;

	protected $sewaRuanganModel;

	protected $sewaAlatModel;

	protected $usersModel;

	protected $galeriRuanganModel;

	protected $galeriAlatModel;

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
		$this->data['judul_halaman'] = 'Fasilitas | Pusat Desain Industri Nasional';
		$this->data['current_page'] = 'fasilitas';
		$this->data['admin'] = false;

		$this->helpers = ['form'];
	}

	public function index()
	{
		$ruangan = $this->ruanganModel->getRuangan();

		////// TODO
		$tipe_ruangan_array = [];
		foreach ($ruangan as $key => $r) {
			$tipe_ruangan = $r['tipe'];
			if (!in_array($tipe_ruangan, $tipe_ruangan_array)) {
				array_push($tipe_ruangan_array, $tipe_ruangan);
			}
		}
		$this->data['tipe_ruangan'] = $tipe_ruangan_array;

		foreach ($ruangan as $key => $r) {
			// $this->data['fotoruangan'][$key] = $this->galeriRuanganModel->where('id_ruangan', $r['id'])->first();
			$foto = $this->galeriRuanganModel->getGaleriByRuangan($r['id']);
			if ($foto) {
				$this->data['fotoruangan'][$key] = $foto[0];
			} else {
				// $this->data['fotoruangan'][$key]['nama_file'] = '...';
				$this->data['fotoruangan'][$key] = null;
			}
		}
		$this->data['ruangan'] = $ruangan;

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

		// $this->data = [
		//     'ruangan' => $this->ruanganModel->getRuangan(),
		//     // 'ruangan' => $this->ruanganModel->paginate(1,'ruangan'),
		//     // 'pager' => $this->ruanganModel->pager,
		//     'alat' => $this->alatModel->getAlat(),
		//     // 'alat' => $this->alatModel->paginate(1,'alat'),
		//     // 'pager' => $this->alatModel->pager,
		//     'judul_halaman' => 'Fasilitas PDIN'
		// ];

		$this->view('fasilitas.php', $this->data);
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

		$this->view('detailruangan.php', $this->data);
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

		$this->view('detailalat.php', $this->data);
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
		$this->usersModel->save([
			'email' => $this->request->getVar('email'),
			'nama' => $this->request->getVar('nama'),
			'kontak' => $this->request->getVar('nomorTelepon'),
			'nama_instansi' => $this->request->getVar('instansi'),
		]);

		$userID = $this->usersModel->insertID();

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
