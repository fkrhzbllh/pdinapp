<?php

namespace App\Controllers\Admin;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use App\Models\PelatihanModel;
use App\Models\PesertaPelatihanModel;
use App\Models\UsersModel;
use App\Models\GaleriAlatModel;
use App\Models\GaleriModel;
use App\Controllers\BaseController;

class LayananPelatihanAdmin extends BaseController
{
	protected $pelatihanModel;
	protected $pesertaPelatihanModel;
	protected $usersModel;
	protected $galeriAlatModel;
	protected $galeriModel;
	protected $helpers = ['form'];
	protected $faker;

	public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
	{
		parent::initController($request, $response, $logger);

		$this->pelatihanModel = new PelatihanModel();
		$this->pesertaPelatihanModel = new pesertaPelatihanModel();
		$this->usersModel = new UsersModel();
		$this->galeriAlatModel = new GaleriAlatModel();
		$this->galeriModel = new GaleriModel();
		$this->helpers = ['form'];
		$this->data['judul_halaman'] = 'Admin | Pusat Desain Industri Nasional';
		$this->data['current_page'] = 'adminpelatihan';
		$this->data['admin'] = true;
		date_default_timezone_set('Asia/Jakarta');
		$this->faker = \Faker\Factory::create();
	}

	public function index()
	{
		$this->data['current_page'] = 'adminpelatihan';
		$this->data['pelatihan'] = $this->pelatihanModel->findAll();
		return view('admin/adminlayananpelatihan.php', $this->data);
	}

	public function alat()
	{
		$this->data['current_page'] = 'adminpelatihan';
		// $perPage = 10;
		// $this->data['per_page'] = $perPage;
		// $this->data['alat'] = $this->alatModel->paginate($perPage, 'alat');
		$this->data['pelatihan'] = $this->pelatihanModel->findAll();
		// $this->data['pager'] = $this->alatModel->pager;
		// $this->data['pager_current'] = $this->alatModel->pager->getCurrentPage('alat');
		return view('admin/adminlayananpelatihan.php', $this->data);
	}

	public function listPelatihan()
	{
		$jadwalSudahSelesai = $this->pelatihanModel->where('tgl_selesai <', date("Y-m-d"))->orderBy('tgl_mulai', 'asc')->findAll();
		$jadwalSedangBerlangsung = $this->pelatihanModel->where('tgl_mulai <=', date("Y-m-d"))->where('tgl_selesai >=', date("Y-m-d"))->orderBy('tgl_mulai', 'asc')->findAll();
		$jadwalAkanDatang = $this->pelatihanModel->where('tgl_mulai >', date("Y-m-d"))->orderBy('tgl_mulai', 'asc')->findAll();

		$jadwalSudahSelesaiArray = [];
		$jadwalSedangBerlangsungArray = [];
		$jadwalAkanDatangArray = [];
		$eventsArray = [];

		foreach ([$jadwalSudahSelesai, $jadwalSedangBerlangsung, $jadwalAkanDatang] as $key => $jadwal) {
			// $this->data[$jadwal] = $jadwal;

			if (!empty($jadwal)) {
				foreach ($jadwal as $key => $value) {
					$eventData = [];

					$eventData = [
						'end' => date_create($value['tgl_selesai'])->format('Y-m-d'),
						'title' => $value['nama_pelatihan'],
						'start' => $value['tgl_mulai'],
						'selesai' => date_create($value['tgl_selesai'])->format('Y-m-d'),
					];


					$eventsArray[] = $eventData;

					// $penyewaData['events'] = $eventData;

					switch ($jadwal) {
						case $jadwalSudahSelesai:
							$jadwalSudahSelesaiArray[] = [
								'events' => $eventData,
								'uuid' => $value['uuid'],
								'id' => $value['id']
							];
							break;

						case $jadwalSedangBerlangsung:
							$jadwalSedangBerlangsungArray[] = [
								'events' => $eventData,
								'uuid' => $value['uuid'],
								'id' => $value['id']
							];
							break;

						case $jadwalAkanDatang:
							$jadwalAkanDatangArray[] = [
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

		return view('admin/adminlayananpelatihan.php', $this->data);
	}

	// form pelatihan
	public function tambahPelatihan()
	{
		session();
		$this->data['current_page'] = 'adminpelatihan';
		$this->data['judul_halaman'] = 'Pelatihan PDIN';

		return view('admin/formtambahpelatihan.php', $this->data);
	}

	// simpan data pelatihan
	public function saveTambahPelatihan()
	{
		// aturan validasi
		$rules = $this->formRulesPelatihan();

		// cek validasi
		if (!$this->validate($rules)) {
			return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
		}

		// simpan data pelatihan
		$this->pelatihanModel->save([
			'uuid' => $this->faker->uuid(),
			'nama_pelatihan' => $this->request->getVar('namaPelatihan'),
			'deskripsi_pelatihan' => $this->request->getVar('deskripsiPelatihan'),
			'tgl_mulai' => $this->request->getVar('tanggalMulai'),
			'tgl_selesai' => $this->request->getVar('tanggalSelesai'),
			'waktu_mulai' => $this->request->getVar('waktuMulai'),
			'waktu_selesai' => $this->request->getVar('waktuSelesai'),
		]);

		session()->setFlashdata('sukses', 'Data berhasil ditambahkan.');

		return redirect()->to('/DashboardAdmin/layanan-pelatihan');
	}

	// form edit pelatihan
	public function updatePelatihan()
	{
		$this->data['current_page'] = 'adminpelatihan';
		$this->data['judul_halaman'] = 'Pelatihan PDIN';

		// ambil data yang dipilih
		$uuid = $this->request->getVar('uuid');
		$pelatihan = $this->pelatihanModel->findByUUID($uuid);
		$this->data['pelatihan'] = $pelatihan;

		return view('admin/formeditpelatihan.php', $this->data);
	}

	// update data pelatihan
	public function saveUpdatePelatihan()
	{
		// aturan validasi
		$rules = $this->formRulesPelatihan();

		// cek validasi
		if (!$this->validate($rules)) {
			return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
		}

		// simpan data 
		$this->pelatihanModel->save([
			'id' => $this->request->getVar('id'),
			'nama_pelatihan' => $this->request->getVar('namaPelatihan'),
			'deskripsi_pelatihan' => $this->request->getVar('deskripsiPelatihan'),
			'tgl_mulai' => $this->request->getVar('tanggalMulai'),
			'tgl_selesai' => $this->request->getVar('tanggalSelesai'),
			'waktu_mulai' => $this->request->getVar('waktuMulai'),
			'waktu_selesai' => $this->request->getVar('waktuSelesai'),
		]);

		session()->setFlashdata('sukses', 'Data berhasil diubah.');

		return redirect()->to('/DashboardAdmin/layanan-pelatihan');
	}

	// hapus pelatihan
	public function deletePelatihan($id)
	{
		$this->pelatihanModel->delete($id);
		return redirect()->to('/DashboardAdmin/layanan-pelatihan');
		// $pelatihan = $this->pelatihanModel->findById($id);

		// if ($pelatihan) {
		// 	$this->pelatihanModel->delete($id);
		// 	session()->setFlashdata('sukses', 'Data berhasil dihapus.');

		// 	return redirect()->to('/DashboardAdmin/layanan-pelatihan');
		// } else {
		// 	session()->setFlashdata('gagal', 'Data gagal dihapus.');

		// 	return redirect()->to('/DashboardAdmin/layanan-pelatihan');
		// }
	}

	// aturan validasi form pelatihan
	public function formRulesPelatihan()
	{
		$rules = [
			'namaPelatihan' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'nama pelatihan harus diisi'
				]
			],
			'tanggalMulai' => [
				'rules' => 'required|valid_date',
				'errors' => [
					'required' => 'tanggal mulai harus diisi',
					'valid_date' => 'tanggal mulai harus valid'
				]
			],
			'tanggalSelesai' => [
				'rules' => 'required|valid_date',
				'errors' => [
					'required' => 'tanggal selesai harus diisi',
					'valid_date' => 'tanggal selesai harus valid'
				]
			],
			'waktuMulai' => [
				'rules' => 'required|valid_date',
				'errors' => [
					'required' => 'waktu mulai harus diisi',
					'valid_date' => 'waktu mulai harus valid'
				]
			],
			'waktuSelesai' => [
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
