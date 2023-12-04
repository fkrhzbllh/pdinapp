<?php

namespace App\Controllers\Admin;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use App\Models\RuanganModel;
use App\Models\SewaRuanganModel;
use App\Models\PenyewaModel;
use App\Models\GaleriRuanganModel;
use App\Models\GaleriModel;
use App\Controllers\BaseController;

class RuanganAdmin extends BaseController
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
		$this->data['judul_halaman'] = 'Admin | Pusat Desain Industri Nasional';
		$this->data['current_page'] = 'adminruangan';
		$this->data['admin'] = true;
		date_default_timezone_set('Asia/Jakarta');
		$this->faker = \Faker\Factory::create();
	}

	public function index()
	{
		$this->data['current_page'] = 'adminruangan';
		$this->data['ruangan'] = $this->ruanganModel->findAll();
		return view('admin/adminruangan.php', $this->data);
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
		return view('admin/adminruangan.php', $this->data);
	}

	// form tambah ruangan
	public function tambahRuangan()
	{
		session();
		$this->data['admin'] = true;
		$this->data['current_page'] = 'adminruangan';
		// $this->data['judul_halaman'] = 'Tambah Ruangan';

		return view('admin/formtambahruangan.php', $this->data);
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

		if ($slug) {
			$ruangan = $this->ruanganModel->getRuangan($slug);
			// tampilan error kalau tidak ada nama ruangan yang ada di database
			if (empty($ruangan)) {
				throw new \CodeIgniter\Exceptions\PageNotFoundException('Ruangan "' . $slug . '" tidak ditemukan.');
			}
		}
		// tampilan error kalau tidak ada nama ruangan yang ada di database
		else if (empty($slug)) {
			throw new \CodeIgniter\Exceptions\PageNotFoundException('Ruangan "' . $slug . '" tidak ditemukan.');
		}

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

		return view('admin/formeditruangan.php', $this->data);
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
			return redirect()->to('/DashboardAdmin/update-ruangan/' . $slugLama)->withInput();
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
				if (file_exists('uploads/' . $fl['nama_file'])) {
					unlink('uploads/' . $fl['nama_file']);
					$this->galeriModel->delete($fl['id_galeri']);
					// $this->galeriRuanganModel->delete($galeriRuangan[$key]['id']);
				}
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
				if (file_exists('uploads/' . $fl['nama_file'])) {
					unlink('uploads/' . $fl['nama_file']);
					$this->galeriModel->delete($fl['id_galeri']);
					// $this->galeriRuanganModel->delete($galeriRuangan[$key]['id']);
				}
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
		// $penyewa = $this->penyewaModel->getPenyewaByID($jadwal['id_penyewa']);
		// $penyewa = $this->penyewaModel->findAll();
		$this->data['ruangan'] = $ruangan;
		$this->data['jadwal'] = $jadwal;
		// $this->data['penyewa'] = $penyewa;

		// menampilkan penyewa sewa ruangan
		if ($jadwal) {
			foreach ($jadwal as $key => $value) {
				$penyewa = $this->penyewaModel->getPenyewaByID($value['id_penyewa']);
				if ($penyewa == null || empty($penyewa)) {
					// dd($this->penyewaModel->getPenyewaByID($jadwal[2]['id_penyewa']));
					$this->data['penyewa'][$key]['nama'] = '';
					$this->data['penyewa'][$key]['kontak'] = '';
					$this->data['penyewa'][$key]['nama_instansi'] = '';
				} else {
					if ($ruangan['tipe'] == 'Pameran') {
						$this->data['events'][$key]['allDay'] = true;
						$this->data['events'][$key]['end'] = date_add(date_create($value['tgl_akhir_sewa']), date_interval_create_from_date_string('1 day'))->format('Y-m-d H:i:s');
					} else $this->data['events'][$key]['end'] = date_create($value['tgl_akhir_sewa'])->format('Y-m-d H:i:s');
					$this->data['penyewa'][$key]['nama'] = $penyewa['nama'];
					$this->data['penyewa'][$key]['kontak'] = $penyewa['kontak'];
					$this->data['penyewa'][$key]['nama_instansi'] = $penyewa['nama_instansi'];
					$this->data['events'][$key]['title'] = $value['nama_kegiatan'];
					$this->data['events'][$key]['start'] = $value['tgl_mulai_sewa'];
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

		return view('admin/adminsewaruangan.php', $this->data);
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

		return view('admin/formtambahsewaruangan.php', $this->data);
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
			return redirect()->to('/DashboardAdmin/tambah-sewa-ruangan/' . $slug)->withInput();
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

		return redirect()->to('/DashboardAdmin/sewa-ruangan/' . $slug);
	}

	// form edit sewa ruangan
	public function updateSewaRuangan($uuid)
	{
		$this->data['current_page'] = 'adminruangan';
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

		return view('admin/formeditsewaruangan.php', $this->data);
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
			return redirect()->to('/DashboardAdmin/update-sewa-ruangan/' . $uuid)->withInput();
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
