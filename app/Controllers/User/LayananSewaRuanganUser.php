<?php

namespace App\Controllers\User;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use App\Models\RuanganModel;
use App\Models\SewaRuanganModel;
use App\Models\PenyewaModel;
use App\Models\GaleriRuanganModel;
use App\Models\GaleriModel;
use App\Controllers\BaseController;

class LayananSewaRuanganUser extends BaseController
{
	protected $ruanganModel;
	protected $sewaRuanganModel;
	protected $penyewaModel;
	protected $galeriRuanganModel;
	protected $galeriModel;
	protected $helpers = ['form'];
	protected $faker;

	public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
	{
		parent::initController($request, $response, $logger);

		$this->ruanganModel = new RuanganModel();
		$this->sewaRuanganModel = new SewaRuanganModel();
		$this->penyewaModel = new PenyewaModel();
		$this->galeriRuanganModel = new GaleriRuanganModel();
		$this->galeriModel = new GaleriModel();
		$this->helpers = ['form'];
		$this->data['judul_halaman'] = 'User | Pusat Desain Industri Nasional';
		$this->data['current_page'] = 'usersewaruangan';
		$this->data['user'] = true;
		date_default_timezone_set('Asia/Jakarta');
		$this->faker = \Faker\Factory::create();
	}

	public function listSewaRuangan()
	{
		$idUser = auth()->id();
		$penyewa = $this->penyewaModel->where(['id_user' => $idUser])->first();

		if (empty($penyewa)) $idPenyewa = '';
		else $idPenyewa = $penyewa['id'];

		$jadwalSudahSelesai = $this->sewaRuanganModel->where('tgl_akhir_sewa <', date("Y-m-d H:i:s"))->where(['id_penyewa' => $idPenyewa])->orderBy('tgl_mulai_sewa', 'asc')->findAll();
		$jadwalSedangBerlangsung = $this->sewaRuanganModel->where('tgl_mulai_sewa <=', date("Y-m-d H:i:s"))->where('tgl_akhir_sewa >=', date("Y-m-d H:i:s"))->where(['id_penyewa' => $idPenyewa])->orderBy('tgl_mulai_sewa', 'asc')->findAll();
		$jadwalAkanDatang = $this->sewaRuanganModel->where('tgl_mulai_sewa >', date("Y-m-d H:i:s"))->where(['id_penyewa' => $idPenyewa])->orderBy('tgl_mulai_sewa', 'asc')->findAll();

		$jadwalSudahSelesaiArray = [];
		$jadwalSedangBerlangsungArray = [];
		$jadwalAkanDatangArray = [];
		$eventsArray = [];

		foreach ([$jadwalSudahSelesai, $jadwalSedangBerlangsung, $jadwalAkanDatang] as $key => $jadwal) {
			// $this->data[$jadwal] = $jadwal;

			if (!empty($jadwal)) {
				foreach ($jadwal as $key => $value) {
					$penyewa = $this->penyewaModel->getPenyewaByID($value['id_penyewa']);
					$ruangan = $this->ruanganModel->getRuanganByID($value['id_ruangan']);

					$penyewaData = $penyewa ? [
						'nama' => $penyewa['nama'],
						'kontak' => $penyewa['kontak'],
						'nama_instansi' => $penyewa['nama_instansi'],
					] : [
						'nama' => '',
						'kontak' => '',
						'nama_instansi' => '',
					];

					$ruanganData = [];
					$eventData = [];

					if ($ruangan) {
						$ruanganData = [
							'nama' => $ruangan['nama'],
							'tipe' => $ruangan['tipe'],
						];

						$eventData = [
							'end' => $ruangan['tipe'] == 'Pameran' ? date_add(date_create($value['tgl_akhir_sewa']), date_interval_create_from_date_string('1 day'))->format('Y-m-d') : date_create($value['tgl_akhir_sewa'])->format('Y-m-d H:i:s'),
							'allDay' => $ruangan['tipe'] == 'Pameran' ? true : false,
							'title' => $value['nama_kegiatan'],
							'start' => $value['tgl_mulai_sewa'],
							'selesai' => date_create($value['tgl_akhir_sewa'])->format('Y-m-d H:i:s'),
							'nama' => $penyewa['nama'],
							'kontak' => $penyewa['kontak'],
							'email' => $penyewa['email'],
							'nama_instansi' => $penyewa['nama_instansi'],
							'deskripsi' => $value['deskripsi'],
							'nama_ruangan' => $ruangan['nama'],
						];
					} else {
						$ruanganData['nama'] = '';
					}

					$eventsArray[] = $eventData;

					// $penyewaData['events'] = $eventData;

					switch ($jadwal) {
						case $jadwalSudahSelesai:
							$jadwalSudahSelesaiArray[] = [
								'penyewa' => $penyewaData,
								'ruangan' => $ruanganData,
								'events' => $eventData,
								'uuid' => $value['uuid'],
								'id' => $value['id']
							];
							break;

						case $jadwalSedangBerlangsung:
							$jadwalSedangBerlangsungArray[] = [
								'penyewa' => $penyewaData,
								'ruangan' => $ruanganData,
								'events' => $eventData,
								'uuid' => $value['uuid'],
								'id' => $value['id']
							];
							break;

						case $jadwalAkanDatang:
							$jadwalAkanDatangArray[] = [
								'penyewa' => $penyewaData,
								'ruangan' => $ruanganData,
								'events' => $eventData,
								'uuid' => $value['uuid'],
								'id' => $value['id']
							];
							break;
					}
				}
			} else {
				// $this->data[$jadwal] = '';
			}
		}

		$this->data['jadwalSudahSelesai'] = $jadwalSudahSelesaiArray;
		$this->data['jadwalSedangBerlangsung'] = $jadwalSedangBerlangsungArray;
		$this->data['jadwalAkanDatang'] = $jadwalAkanDatangArray;
		$this->data['events'] = $eventsArray;

		return view('user/userlayanansewaruangan.php', $this->data);
	}

	// form sewa ruangan
	public function tambahSewaRuangan()
	{
		session();
		$this->data['current_page'] = 'usersewaruangan';
		$this->data['judul_halaman'] = 'Sewa Ruangan PDIN';
		$this->data['id_ruangan'] = '';
		$this->data['ruangan'] = $this->ruanganModel->getRuangan(); // find all

		return view('user/formtambahsewaruangan.php', $this->data);
	}

	// simpan data sewa ruangan
	public function saveTambahSewaRuangan()
	{
		$tipe = $this->request->getVar('tipe');
		$idRuangan = $this->request->getVar('ruangan');
		$ruangan = $this->ruanganModel->getRuanganByID($idRuangan);
		$slug = $ruangan['slug'];

		// aturan validasi
		$rules = $this->formRulesSewaRuangan($tipe);

		// cek validasi
		if (!$this->validate($rules)) {
			return redirect()->to('/dashboard-user/tambah-sewa-ruangan/' . $slug)->withInput();
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
				'uuid' => $this->faker->uuid(),
				'id_ruangan' => $idRuangan,
				'nama_kegiatan' => $this->request->getVar('namaKegiatan'),
				'deskripsi' => $this->request->getVar('deskripsiKegiatan'),
				'id_penyewa' => $userID,
				'tgl_mulai_sewa' => $this->request->getVar('tanggalMulaiPameran'),
				'tgl_akhir_sewa' => $this->request->getVar('tanggalSelesaiPameran'),
			]);
		} elseif ($tipe == 'Kantor') {
			$this->sewaRuanganModel->save([
				'uuid' => $this->faker->uuid(),
				'id_ruangan' => $idRuangan,
				'nama_kegiatan' => $this->request->getVar('namaKegiatan'),
				'deskripsi' => $this->request->getVar('deskripsiKegiatan'),
				'id_penyewa' => $userID,
				'tgl_mulai_sewa' => $this->request->getVar('tanggalMulaiKantor'),
				'tgl_akhir_sewa' => $this->request->getVar('tanggalSelesaiKantor'),
			]);
		} elseif ($tipe == 'Meeting') {
			$this->sewaRuanganModel->save([
				'uuid' => $this->faker->uuid(),
				'id_ruangan' => $idRuangan,
				'nama_kegiatan' => $this->request->getVar('namaKegiatan'),
				'deskripsi' => $this->request->getVar('deskripsiKegiatan'),
				'id_penyewa' => $userID,
				'tgl_mulai_sewa' => $this->request->getVar('tanggalMulaiMeeting'),
				'tgl_akhir_sewa' => $this->request->getVar('tanggalSelesaiMeeting'),
			]);
		} elseif ($tipe == 'Pengembangan') {
			$this->sewaRuanganModel->save([
				'uuid' => $this->faker->uuid(),
				'id_ruangan' => $idRuangan,
				'nama_kegiatan' => $this->request->getVar('namaKegiatan'),
				'deskripsi' => $this->request->getVar('deskripsiKegiatan'),
				'id_penyewa' => $userID,
				'tgl_mulai_sewa' => $this->request->getVar('tanggalMulaiPengembangan'),
				'tgl_akhir_sewa' => $this->request->getVar('tanggalSelesaiPengembangan'),
			]);
		}

		session()->setFlashdata('sukses', 'Data berhasil ditambahkan.');

		return redirect()->to('/dashboard-user/layanan-sewa-ruangan');
	}

	// form edit sewa ruangan
	public function updateSewaRuangan($uuid)
	{
		$this->data['current_page'] = 'usersewaruangan';
		$this->data['judul_halaman'] = 'Sewa Ruangan PDIN';

		// ambil data jadwal yang dipilih
		$jadwal = $this->sewaRuanganModel->getJadwalByUUID($uuid);
		$this->data['jadwal'] = $jadwal;

		// ambil data ruangan berdasarkan jadwal
		$ruangan = $this->ruanganModel->getRuanganByID($jadwal['id_ruangan']);
		$this->data['ruangan'] = $ruangan;
		$this->data['id_ruangan'] = $jadwal['id_ruangan'];

		// ambil data penyewa berdasarkan jadwal
		$penyewa = $this->penyewaModel->getPenyewaByID($jadwal['id_penyewa']);
		$this->data['penyewa'] = $penyewa;

		return view('user/formeditsewaruangan.php', $this->data);
	}

	// update data sewa ruangan
	public function saveUpdateSewaRuangan($idJadwal, $idPenyewa)
	{
		$tipe = $this->request->getVar('tipe');
		$idRuangan = $this->request->getVar('ruangan');
		$uuid = $this->request->getVar('uuid');
		$ruangan = $this->ruanganModel->getRuanganByID($idRuangan);
		$slug = $ruangan['slug'];

		// aturan validasi
		$rules = $this->formRulesSewaRuangan($tipe);

		// cek validasi
		if (!$this->validate($rules)) {
			return redirect()->to('/dashboard-user/update-sewa-ruangan/' . $uuid)->withInput();
		}

		// simpan data user
		$this->penyewaModel->save([
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
				'id_penyewa' => $idPenyewa,
				'tgl_mulai_sewa' => $this->request->getVar('tanggalMulaiPameran'),
				'tgl_akhir_sewa' => $this->request->getVar('tanggalSelesaiPameran'),
			]);
		} elseif ($tipe == 'Kantor') {
			$this->sewaRuanganModel->save([
				'id' => $idJadwal,
				'id_ruangan' => $idRuangan,
				'nama_kegiatan' => $this->request->getVar('namaKegiatan'),
				'deskripsi' => $this->request->getVar('deskripsiKegiatan'),
				'id_penyewa' => $idPenyewa,
				'tgl_mulai_sewa' => $this->request->getVar('tanggalMulaiKantor'),
				'tgl_akhir_sewa' => $this->request->getVar('tanggalSelesaiKantor'),
			]);
		} elseif ($tipe == 'Meeting') {
			$this->sewaRuanganModel->save([
				'id' => $idJadwal,
				'id_ruangan' => $idRuangan,
				'nama_kegiatan' => $this->request->getVar('namaKegiatan'),
				'deskripsi' => $this->request->getVar('deskripsiKegiatan'),
				'id_penyewa' => $idPenyewa,
				'tgl_mulai_sewa' => $this->request->getVar('tanggalMulaiMeeting'),
				'tgl_akhir_sewa' => $this->request->getVar('tanggalSelesaiMeeting'),
			]);
		} elseif ($tipe == 'Pengembangan') {
			$this->sewaRuanganModel->save([
				'id' => $idJadwal,
				'id_ruangan' => $idRuangan,
				'nama_kegiatan' => $this->request->getVar('namaKegiatan'),
				'deskripsi' => $this->request->getVar('deskripsiKegiatan'),
				'id_penyewa' => $idPenyewa,
				'tgl_mulai_sewa' => $this->request->getVar('tanggalMulaiPengembangan'),
				'tgl_akhir_sewa' => $this->request->getVar('tanggalSelesaiPengembangan'),
			]);
		}

		session()->setFlashdata('sukses', 'Data berhasil diubah.');

		return redirect()->to('/dashboard-user/layanan-sewa-ruangan');
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

			return redirect()->to('/dashboard-user/layanan-sewa-ruangan');
		} else {
			session()->setFlashdata('gagal', 'Data gagal dihapus.');

			return redirect()->to('/dashboard-user/layanan-sewa-ruangan');
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
}
