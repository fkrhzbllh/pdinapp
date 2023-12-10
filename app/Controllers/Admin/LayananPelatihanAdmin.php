<?php

namespace App\Controllers\Admin;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use App\Models\PelatihanModel;
use App\Models\PesertaPelatihanModel;
use App\Models\DaftarPesertaPelatihanModel;
use App\Models\PenyewaModel;
use App\Controllers\BaseController;

class LayananPelatihanAdmin extends BaseController
{
	protected $pelatihanModel;
	protected $pesertaPelatihanModel;
	protected $daftarPesertaPelatihanModel;
	protected $penyewaModel;
	protected $helpers = ['form'];
	protected $faker;

	public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
	{
		parent::initController($request, $response, $logger);

		$this->pelatihanModel = new PelatihanModel();
		$this->pesertaPelatihanModel = new pesertaPelatihanModel();
		$this->daftarPesertaPelatihanModel = new DaftarPesertaPelatihanModel();
		$this->penyewaModel = new PenyewaModel();
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

		return view('admin/adminlayananpelatihan.php', $this->data);
	}

	public function detailPelatihan($uuid)
	{
		$pelatihan = $this->pelatihanModel->findByUUID($uuid);
		$peserta = $this->pesertaPelatihanModel->getPesertaByIDPelatihan($pelatihan['id']);

		// dd($peserta);
		$this->data['current_page'] = 'adminpelatihan';
		$this->data['pelatihan'] = $pelatihan;
		$this->data['peserta'] = $peserta;

		return view('admin/admindetaillayananpelatihan.php', $this->data);
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
	public function updatePelatihan($uuid)
	{
		$this->data['current_page'] = 'adminpelatihan';
		$this->data['judul_halaman'] = 'Pelatihan PDIN';

		// ambil data yang dipilih
		// $uuid = $this->request->getVar('uuid');
		$pelatihan = $this->pelatihanModel->findByUUID($uuid);
		$this->data['pelatihan'] = $pelatihan;
		$this->data['uuid'] = $uuid;

		return view('admin/formeditpelatihan.php', $this->data);
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

		return redirect()->to('/DashboardAdmin/layanan-pelatihan');
	}

	// hapus pelatihan
	public function deletePelatihan($id)
	{
		// $this->pelatihanModel->delete($id);
		// return redirect()->to('/DashboardAdmin/layanan-pelatihan');
		$pelatihan = $this->pelatihanModel->findById($id);

		if ($pelatihan) {
			$this->pelatihanModel->delete($id);
			session()->setFlashdata('sukses', 'Data berhasil dihapus.');

			return redirect()->to('/DashboardAdmin/layanan-pelatihan');
		} else {
			session()->setFlashdata('gagal', 'Data gagal dihapus.');

			return redirect()->to('/DashboardAdmin/layanan-pelatihan');
		}
	}
	// form pelatihan
	public function tambahPeserta($uuid)
	{
		$pelatihan = $this->pelatihanModel->findByUUID($uuid);
		$peserta = $this->pesertaPelatihanModel->findAll();

		$this->data['current_page'] = 'adminpelatihan';
		$this->data['judul_halaman'] = 'Pelatihan PDIN';
		$this->data['pelatihan'] = $pelatihan;
		$this->data['peserta'] = $peserta;

		return view('admin/formtambahpeserta.php', $this->data);
	}

	// simpan data peserta baru
	public function saveTambahPesertaBaru()
	{
		// aturan validasi
		$rules = $this->formRulesPeserta('required|is_unique[peserta_pelatihan.email]');

		// cek validasi
		if (!$this->validate($rules)) {
			return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
		}

		// simpan data peserta pelatihan
		$this->pesertaPelatihanModel->save([
			'uuid' => $this->faker->uuid(),
			'nama' => $this->request->getVar('nama'),
			'email' => $this->request->getVar('email'),
			'kontak' => $this->request->getVar('kontak'),
		]);

		$id_peserta = $this->pesertaPelatihanModel->insertID();

		// simpan data daftar peserta pelatihan
		$this->daftarPesertaPelatihanModel->save([
			'id_peserta_pelatihan' => $id_peserta,
			'id_pelatihan' => $this->request->getVar('id_pelatihan'),
		]);

		session()->setFlashdata('sukses', 'Data berhasil ditambahkan.');

		return redirect()->to('/DashboardAdmin/detail-pelatihan/' . $this->request->getVar('uuid'));
	}

	// simpan data peserta baru
	public function saveTambahPesertaLama()
	{
		// aturan validasi
		$rules = $this->formRulesPesertaLama();

		// cek validasi
		if (!$this->validate($rules)) {
			return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
		}

		// simpan data daftar peserta pelatihan
		$this->daftarPesertaPelatihanModel->save([
			'id_peserta_pelatihan' => $this->request->getVar('peserta'),
			'id_pelatihan' => $this->request->getVar('id_pelatihan'),
		]);

		session()->setFlashdata('sukses', 'Data berhasil ditambahkan.');

		return redirect()->to('/DashboardAdmin/detail-pelatihan/' . $this->request->getVar('uuid'));
	}

	// form edit peserta
	public function updatePeserta($uuidPeserta, $uuidPelatihan)
	{
		$this->data['current_page'] = 'adminpelatihan';
		$this->data['judul_halaman'] = 'Pelatihan PDIN';

		// ambil data yang dipilih
		// $uuidPeserta = $this->request->getVar('uuidPeserta');
		$peserta = $this->pesertaPelatihanModel->findByUUID($uuidPeserta);
		$this->data['peserta'] = $peserta;
		$this->data['uuidPeserta'] = $uuidPeserta;
		$this->data['uuidPelatihan'] = $uuidPelatihan;

		return view('admin/formeditpeserta.php', $this->data);
	}

	// update data peserta
	public function saveUpdatePeserta()
	{
		$emailLama = $this->request->getVar('emailLama');

		$emailLama == $this->request->getVar('email') ? $rule = 'required' : $rule = 'required|is_unique[peserta_pelatihan.email]';

		// aturan validasi
		$rules = $this->formRulesPeserta($rule);

		// cek validasi
		if (!$this->validate($rules)) {
			return redirect()->back()->withInput()->with('errors', $this->validator->getErrors())->with('uuid', $this->request->getVar('uuid'));
		}

		// simpan data 
		$this->pesertaPelatihanModel->save([
			'id' => $this->request->getVar('id'),
			'nama' => $this->request->getVar('nama'),
			'email' => $this->request->getVar('email'),
			'kontak' => $this->request->getVar('kontak'),
		]);

		$peserta = $this->pesertaPelatihanModel->findByUUID($this->request->getVar('uuid'));
		if ($peserta['id_user'] != null) {
			$users = auth()->getProvider();

			$user = $users->findById($peserta['id_user']);
			$user->fill([
				'email' => $this->request->getVar('email'),
			]);

			$users->save($user);

			$penyewa = $this->penyewaModel->where('id_user', $peserta['id_user'])->find();
			if ($penyewa) {
				$this->penyewaModel->save([
					'id' => $penyewa['id'],
					'email' => $this->request->getVar('email'),
				]);
			}
		}

		session()->setFlashdata('sukses', 'Data berhasil diubah.');

		return redirect()->to('/DashboardAdmin/detail-pelatihan/' . $this->request->getVar('uuid'));
	}

	// hapus peserta
	public function deletePeserta($idPeserta, $idPelatihan, $uuidPelatihan)
	{
		// $this->pelatihanModel->delete($id);
		// return redirect()->to('/DashboardAdmin/layanan-pelatihan');
		$peserta = $this->daftarPesertaPelatihanModel->where(['id_peserta_pelatihan' => $idPeserta, 'id_pelatihan' => $idPelatihan])->first();

		if ($peserta) {
			$this->daftarPesertaPelatihanModel->delete($peserta['id']);
			session()->setFlashdata('sukses', 'Data berhasil dihapus.');

			return redirect()->to('/DashboardAdmin/detail-pelatihan/' . $uuidPelatihan);
		} else {
			session()->setFlashdata('gagal', 'Data gagal dihapus.');

			return redirect()->to('/DashboardAdmin/detail-pelatihan/' . $uuidPelatihan);
		}
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

	// aturan validasi form peserta
	public function formRulesPeserta($rule)
	{
		$rules = [
			'nama' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'nama harus diisi'
				]
			],
			'kontak' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'kontak harus diisi',
				]
			],
			'email' => [
				'rules' => $rule,
				'errors' => [
					'required' => 'email harus diisi',
					'is_unique' => 'email harus unik'
				]
			]
		];

		return $rules;
	}

	// aturan validasi form peserta
	public function formRulesPesertaLama()
	{
		$rules = [
			'peserta' => [
				'rules' => 'required|is_unique[peserta_pelatihan.email]',
				'errors' => [
					'required' => 'peserta harus diisi',
					'is_unique' => 'peserta sudah ada'
				]
			]
		];

		return $rules;
	}
}
