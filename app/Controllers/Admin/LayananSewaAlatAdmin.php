<?php

namespace App\Controllers\Admin;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use App\Models\AlatModel;
use App\Models\SewaAlatModel;
use App\Models\UsersModel;
use App\Models\GaleriAlatModel;
use App\Models\GaleriModel;
use App\Controllers\BaseController;

class LayananSewaAlatAdmin extends BaseController
{
	protected $alatModel;
	protected $sewaAlatModel;
	protected $usersModel;
	protected $galeriAlatModel;
	protected $galeriModel;
	protected $helpers = ['form'];
	protected $faker;

	public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
	{
		parent::initController($request, $response, $logger);

		$this->alatModel = new AlatModel();
		$this->sewaAlatModel = new SewaAlatModel();
		$this->usersModel = new UsersModel();
		$this->galeriAlatModel = new GaleriAlatModel();
		$this->galeriModel = new GaleriModel();
		$this->helpers = ['form'];
		$this->data['judul_halaman'] = 'Admin | Pusat Desain Industri Nasional';
		$this->data['current_page'] = 'adminsewaalat';
		$this->data['admin'] = true;
		date_default_timezone_set('Asia/Jakarta');
		$this->faker = \Faker\Factory::create();
	}

	public function index()
	{
		$this->data['current_page'] = 'adminsewaalat';
		$this->data['alat'] = $this->alatModel->findAll();
		return view('admin/adminlayanansewaalat.php', $this->data);
	}

	public function alat()
	{
		$this->data['current_page'] = 'adminsewaalat';
		// $perPage = 10;
		// $this->data['per_page'] = $perPage;
		// $this->data['alat'] = $this->alatModel->paginate($perPage, 'alat');
		$this->data['alat'] = $this->alatModel->findAll();
		// $this->data['pager'] = $this->alatModel->pager;
		// $this->data['pager_current'] = $this->alatModel->pager->getCurrentPage('alat');
		return view('admin/adminlayanansewaalat.php', $this->data);
	}

	public function listSewaAlat()
	{
		$jadwalSudahSelesai = $this->sewaAlatModel->where('tgl_akhir_sewa <', date("Y-m-d H:i:s"))->orderBy('tgl_mulai_sewa', 'asc')->findAll();
		$jadwalSedangBerlangsung = $this->sewaAlatModel->where('tgl_mulai_sewa <=', date("Y-m-d H:i:s"))->where('tgl_akhir_sewa >=', date("Y-m-d H:i:s"))->orderBy('tgl_mulai_sewa', 'asc')->findAll();
		$jadwalAkanDatang = $this->sewaAlatModel->where('tgl_mulai_sewa >', date("Y-m-d H:i:s"))->orderBy('tgl_mulai_sewa', 'asc')->findAll();

		$jadwalSudahSelesaiArray = [];
		$jadwalSedangBerlangsungArray = [];
		$jadwalAkanDatangArray = [];
		$eventsArray = [];

		foreach ([$jadwalSudahSelesai, $jadwalSedangBerlangsung, $jadwalAkanDatang] as $key => $jadwal) {
			// $this->data[$jadwal] = $jadwal;

			if (!empty($jadwal)) {
				foreach ($jadwal as $key => $value) {
					$penyewa = $this->usersModel->getUserByID($value['id_user']);
					$alat = $this->alatModel->getAlatByID($value['id_alat']);

					$penyewaData = $penyewa ? [
						'nama' => $penyewa['nama'],
						'kontak' => $penyewa['kontak'],
						'nama_instansi' => $penyewa['nama_instansi'],
					] : [
						'nama' => '',
						'kontak' => '',
						'nama_instansi' => '',
					];

					$alatData = [];
					$eventData = [];

					if ($alat) {
						$alatData = [
							'nama' => $alat['nama'],
						];

						$eventData = [
							'end' => date_create($value['tgl_akhir_sewa'])->format('Y-m-d H:i:s'),
							'title' => $value['nama_kegiatan'],
							'start' => $value['tgl_mulai_sewa'],
							'selesai' => date_create($value['tgl_akhir_sewa'])->format('Y-m-d H:i:s'),
							'nama' => $penyewa['nama'],
							'kontak' => $penyewa['kontak'],
							'email' => $penyewa['email'],
							'nama_instansi' => $penyewa['nama_instansi'],
							'deskripsi' => $value['deskripsi'],
							'nama_alat' => $alat['nama'],
						];
					} else {
						$alatData['nama'] = '';
					}

					$eventsArray[] = $eventData;

					// $penyewaData['events'] = $eventData;

					switch ($jadwal) {
						case $jadwalSudahSelesai:
							$jadwalSudahSelesaiArray[] = [
								'penyewa' => $penyewaData,
								'alat' => $alatData,
								'events' => $eventData,
								'uuid' => $value['uuid'],
								'id' => $value['id']
							];
							break;

						case $jadwalSedangBerlangsung:
							$jadwalSedangBerlangsungArray[] = [
								'penyewa' => $penyewaData,
								'alat' => $alatData,
								'events' => $eventData,
								'uuid' => $value['uuid'],
								'id' => $value['id']
							];
							break;

						case $jadwalAkanDatang:
							$jadwalAkanDatangArray[] = [
								'penyewa' => $penyewaData,
								'alat' => $alatData,
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

		return view('admin/adminlayanansewaalat.php', $this->data);
	}

	// form sewa alat
	public function tambahSewaAlat()
	{
		session();
		$this->data['current_page'] = 'adminsewaalat';
		$this->data['judul_halaman'] = 'Sewa Ruangan PDIN';
		$this->data['id_alat'] = '';
		$this->data['alat'] = $this->alatModel->getAlat(); // find all

		return view('admin/formtambahsewaalat.php', $this->data);
	}

	// simpan data sewa alat
	public function saveTambahSewaAlat()
	{
		$tipe = $this->request->getVar('tipe');
		$idAlat = $this->request->getVar('alat');
		$alat = $this->alatModel->getAlatByID($idAlat);
		$slug = $alat['slug'];

		// aturan validasi
		$rules = $this->formRulesSewaAlat();

		// cek validasi
		if (!$this->validate($rules)) {
			return redirect()->to('/DashboardAdmin/tambah-sewa-alat/' . $slug)->withInput();
		}

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
			'uuid' => $this->faker->uuid(),
			'id_alat' => $idAlat,
			'nama_kegiatan' => $this->request->getVar('namaKegiatan'),
			'deskripsi' => $this->request->getVar('deskripsiKegiatan'),
			'id_user' => $userID,
			'tgl_mulai_sewa' => $this->request->getVar('tanggalMulai'),
			'tgl_akhir_sewa' => $this->request->getVar('tanggalSelesai'),
		]);

		session()->setFlashdata('sukses', 'Data berhasil ditambahkan.');

		return redirect()->to('/DashboardAdmin/layanan-sewa-alat');
	}

	// form edit sewa alat
	public function updateSewaAlat($uuid)
	{
		$this->data['current_page'] = 'adminsewaalat';
		$this->data['judul_halaman'] = 'Sewa Alat PDIN';

		// ambil data jadwal yang dipilih
		$jadwal = $this->sewaAlatModel->getJadwalByUUID($uuid);
		$this->data['jadwal'] = $jadwal;

		// ambil data alat berdasarkan jadwal
		$alat = $this->alatModel->getAlatByID($jadwal['id_alat']);
		$this->data['alat'] = $alat;
		$this->data['id_alat'] = $jadwal['id_alat'];

		// ambil data penyewa berdasarkan jadwal
		$penyewa = $this->usersModel->getUserByID($jadwal['id_user']);
		$this->data['penyewa'] = $penyewa;

		return view('admin/formeditsewaalat.php', $this->data);
	}

	// update data sewa alat
	public function saveUpdateSewaAlat($idJadwal, $idPenyewa)
	{
		$tipe = $this->request->getVar('tipe');
		$idAlat = $this->request->getVar('alat');
		$uuid = $this->request->getVar('uuid');
		$alat = $this->alatModel->getAlatByID($idAlat);
		$slug = $alat['slug'];

		// aturan validasi
		$rules = $this->formRulesSewaAlat();

		// cek validasi
		if (!$this->validate($rules)) {
			return redirect()->to('/DashboardAdmin/update-sewa-alat/' . $uuid)->withInput();
		}

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

		session()->setFlashdata('sukses', 'Data berhasil diubah.');

		return redirect()->to('/DashboardAdmin/layanan-sewa-alat');
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

			return redirect()->to('/DashboardAdmin/layanan-sewa-alat');
		} else {
			session()->setFlashdata('gagal', 'Data gagal dihapus.');

			return redirect()->to('/DashboardAdmin/layanan-sewa-alat');
		}
	}

	// aturan validasi form sewa alat
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
