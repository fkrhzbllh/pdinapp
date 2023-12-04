<?php

namespace App\Controllers\User;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use App\Models\PelatihanModel;
use App\Models\PesertaPelatihanModel;
use App\Models\PenyewaModel;
use App\Models\GaleriAlatModel;
use App\Models\GaleriModel;
use App\Controllers\BaseController;

class LayananPelatihanUser extends BaseController
{
	protected $pelatihanModel;
	protected $pesertaPelatihanModel;
	protected $penyewaModel;
	protected $galeriAlatModel;
	protected $galeriModel;
	protected $helpers = ['form'];
	protected $faker;

	public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
	{
		parent::initController($request, $response, $logger);

		$this->pelatihanModel = new PelatihanModel();
		$this->pesertaPelatihanModel = new pesertaPelatihanModel();
		$this->penyewaModel = new PenyewaModel();
		$this->galeriAlatModel = new GaleriAlatModel();
		$this->galeriModel = new GaleriModel();
		$this->helpers = ['form'];
		$this->data['judul_halaman'] = 'User | Pusat Desain Industri Nasional';
		$this->data['current_page'] = 'userpelatihan';
		$this->data['user'] = true;
		date_default_timezone_set('Asia/Jakarta');
		$this->faker = \Faker\Factory::create();
	}

	public function index()
	{
		$this->data['current_page'] = 'userpelatihan';
		$this->data['pelatihan'] = $this->pelatihanModel->findAll();
		return view('user/userlayananpelatihan.php', $this->data);
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
						'end' => date_add(date_create($value['tgl_selesai']), date_interval_create_from_date_string('1 day'))->format('Y-m-d'),
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

		return view('user/userlayananpelatihan.php', $this->data);
	}

	// form pelatihan
	public function tambahPelatihan()
	{
		session();
		$this->data['current_page'] = 'userpelatihan';
		$this->data['judul_halaman'] = 'Pelatihan PDIN';

		return view('user/formtambahpelatihan.php', $this->data);
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

		return redirect()->to('/dashboard-user/layanan-pelatihan');
	}

	// form edit pelatihan
	public function updatePelatihan($uuid)
	{
		$this->data['current_page'] = 'userpelatihan';
		$this->data['judul_halaman'] = 'Pelatihan PDIN';

		// ambil data yang dipilih
		// $uuid = $this->request->getVar('uuid');
		$pelatihan = $this->pelatihanModel->findByUUID($uuid);
		$this->data['pelatihan'] = $pelatihan;
		$this->data['uuid'] = $uuid;

		return view('user/formeditpelatihan.php', $this->data);
	}

	// update data pelatihan
	public function saveUpdatePelatihan()
	{
		// aturan validasi
		$rules = $this->formRulesPelatihan();

		// cek validasi
		if (!$this->validate($rules)) {
			return redirect()->back()->withInput()->with('errors', $this->validator->getErrors())->with('uuid', $this->request->getVar('uuid'));
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

		return redirect()->to('/dashboard-user/layanan-pelatihan');
	}

	// hapus pelatihan
	public function deletePelatihan($id)
	{
		$this->pelatihanModel->delete($id);
		return redirect()->to('/dashboard-user/layanan-pelatihan');
		// $pelatihan = $this->pelatihanModel->findById($id);

		// if ($pelatihan) {
		// 	$this->pelatihanModel->delete($id);
		// 	session()->setFlashdata('sukses', 'Data berhasil dihapus.');

		// 	return redirect()->to('/dashboard-user/layanan-pelatihan');
		// } else {
		// 	session()->setFlashdata('gagal', 'Data gagal dihapus.');

		// 	return redirect()->to('/dashboard-user/layanan-pelatihan');
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
