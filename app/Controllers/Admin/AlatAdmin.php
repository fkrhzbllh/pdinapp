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

class AlatAdmin extends BaseController
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
		$this->data['current_page'] = 'adminalat';
		$this->data['admin'] = true;
		date_default_timezone_set('Asia/Jakarta');
		$this->faker = \Faker\Factory::create();
	}

	public function index()
	{
		$this->data['current_page'] = 'adminalat';
		$this->data['alat'] = $this->alatModel->findAll();
		return view('admin/adminralat.php', $this->data);
	}

	public function alat()
	{
		$this->data['current_page'] = 'adminalat';
		$this->data['alat'] = $this->alatModel->findAll();
		return view('admin/adminalat.php', $this->data);
	}

	// form tambah alat
	public function tambahAlat()
	{
		session();
		$this->data['current_page'] = 'adminalat';
		$this->data['admin'] = true;
		$this->data['judul_halaman'] = 'Tambah Alat';

		return view('admin/formtambahalat.php', $this->data);
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
		// $alat = $this->alatModel->getAlat($slug);

		if ($slug) {
			$alat = $this->alatModel->getAlat($slug);
			// tampilan error kalau tidak ada nama alat yang ada di database
			if (empty($alat)) {
				throw new \CodeIgniter\Exceptions\PageNotFoundException('Alat "' . $slug . '" tidak ditemukan.');
			}
		}
		// tampilan error kalau tidak ada nama alat yang ada di database
		else if (empty($slug)) {
			throw new \CodeIgniter\Exceptions\PageNotFoundException('Alat "' . $slug . '" tidak ditemukan.');
		}

		$this->data['admin'] = true;
		$this->data['alat'] = $alat;
		// $this->data['judul_halaman'] = 'Tambah Alat';
		$this->data['fotoalat'] = $this->galeriAlatModel->getGaleriByAlat($alat['id']);

		return view('admin/formeditalat.php', $this->data);
	}

	// simpan update alat
	public function saveUpdateAlat($id)
	{
		$this->data['current_page'] = 'adminalat';
		$slugLama = $this->request->getVar('slug');

		($slugLama == url_title($this->request->getVar('nama'))) ? $rules_nama = 'required' : $rules_nama = 'required|is_unique[alat.nama]';

		// aturan validasi
		$rules = $this->formRulesAlat($rules_nama);

		// cek validasi
		if (!$this->validate($rules)) {
			return redirect()->to('/DashboardAdmin/update-alat/' . $slugLama)->withInput();
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

	// list sewa suatu alat
	public function listSewaAlat($slug)
	{
		$this->data['current_page'] = 'adminalat';
		$alat = $this->alatModel->getAlat($slug);

		// tampilan error kalau tidak ada nama alat yang ada di database
		if (empty($alat)) {
			throw new \CodeIgniter\Exceptions\PageNotFoundException('Alat "' . $slug . '" tidak ditemukan.');
		}
		// $this->data['id_alat'] = $id;
		$jadwal = $this->sewaAlatModel->getJadwalSewaAlat($alat['id']);
		// $penyewa = $this->usersModel->getUserByID($jadwal['id_user']);
		// $penyewa = $this->usersModel->findAll();
		$this->data['alat'] = $alat;
		$this->data['jadwal'] = $jadwal;
		// $this->data['penyewa'] = $penyewa;

		// menampilkan penyewa sewa alat
		if ($jadwal) {
			foreach ($jadwal as $key => $value) {
				$penyewa = $this->usersModel->getUserByID($value['id_user']);
				if ($penyewa == null || empty($penyewa)) {
					// dd($this->usersModel->getUserByID($jadwal[2]['id_user']));
					$this->data['penyewa'][$key]['nama'] = '';
					$this->data['penyewa'][$key]['kontak'] = '';
					$this->data['penyewa'][$key]['nama_instansi'] = '';
				} else {
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
				}
			}
		} else {
			$this->data['penyewa'] = '';
			$this->data['events'] = '';
		}

		$this->data['judul_halaman'] = 'Sewa ' . $alat['nama'];

		return view('admin/adminsewaalat.php', $this->data);
	}

	// form sewa alat
	public function tambahSewaAlat($slug = null)
	{
		session();
		$alat = $this->alatModel->getAlat($slug);

		// tampilan error kalau tidak ada nama ruangan yang ada di database
		if (empty($ruangan)) {
			throw new \CodeIgniter\Exceptions\PageNotFoundException('Ruangan "' . $slug . '" tidak ditemukan.');
		}

		$this->data['current_page'] = 'adminalat';
		$this->data['id_alat'] = $alat['id'];
		$this->data['judul_halaman'] = 'Sewa Alat PDIN';
		$this->data['alat'] = $this->alatModel->getAlat(); // find all

		return view('admin/sewaalat.php', $this->data);
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

		// get slug
		$alat = $this->alatModel->getAlatByID($idAlat);
		$namaAlat = $alat['slug'];

		session()->setFlashdata('sukses', 'Data berhasil ditambahkan.');

		return redirect()->to('/DashboardAdmin/sewa-alat/' . $namaAlat);
	}

	// form edit sewa alat
	public function updateSewaAlat($uuid)
	{
		$this->data['current_page'] = 'adminalat';
		$this->data['judul_halaman'] = 'Sewa Alat PDIN';

		// ambil data jadwal yang dipilih
		$jadwal = $this->sewaAlatModel->getJadwalByID($uuid);
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
