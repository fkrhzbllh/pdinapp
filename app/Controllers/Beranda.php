<?php

namespace App\Controllers;

use App\Models\ArtikelModel;
use App\Models\RuanganModel;
use App\Models\KegiatanModel;
use App\Models\GaleriRuanganModel;
use App\Models\GaleriKegiatanModel;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class Beranda extends BaseController
{

	// Model
	protected $artikelModel;
	protected $ruanganModel;
	protected $kegiatanModel;
	protected $galeriRuanganModel;
	protected $galeriKegiatanModel;

	public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
	{
		parent::initController($request, $response, $logger);

		// Model artikel untuk section Kegiatan
		$this->artikelModel = new ArtikelModel();

		// Kegiatan model untuk bagian kegiatan
		$this->kegiatanModel = new KegiatanModel();

		// Ruangan & galeri ruangan untuk slider foto bagian fasilitas
		$this->ruanganModel = new RuanganModel();
		$this->galeriRuanganModel = new GaleriRuanganModel();

		// Galeri
		$this->galeriKegiatanModel = new GaleriKegiatanModel();

		$this->data['judul_halaman'] = 'Beranda | Pusat Desain Industri Nasional';
		$this->data['current_page'] = 'beranda';
	}

	public function index()
	{

		// Section artikel, ambil 4 artikel terbaru untuk Sorotan
		$artikelTerbaru = $this->artikelModel->getArtikelTerbaru(4);
		$this->data['artikelTerbaru'] = $artikelTerbaru;

		// Section artikel, ambil 4 artikel pilihan dari Model Artikel untuk dimasukkan ke list Artikel Pilihan
		$artikelPilihan = $this->artikelModel->getArtikelPilihan(4, 12);
		$this->data['artikelPilihan'] = $artikelPilihan;

		// Section fasilitas, ambil foto ruangan untuk dijadikan slider
		$ruangan = $this->ruanganModel->getRuangan();
		foreach ($ruangan as $key => $r) {
			$foto = $this->galeriRuanganModel->getGaleriByRuangan($r['id']); // Ambil foto ruangan berdasarkan ID
			if ($foto) {
				$this->data['fotoruangan'][$key] = $foto[0];
			} else {

				$this->data['fotoruangan'][$key] = null;
			}
		}

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
		$this->data['ruangan'] = $ruangan; // Simpan data ruangan untuk view
		$this->data['ruangan_berfoto'] = $ruangan_berfoto; // Khusus ruangan yang berfoto
		$this->data['foto_ruangan_berfoto'] = $foto_ruangan_berfoto; // Khusus ruangan yang berfoto

		// Section kegiatan
		$kegiatan = $this->kegiatanModel->findAll();

		if ($kegiatan) {
			foreach ($kegiatan as $key => $value) {
				$this->data['jadwal_kegiatan'][$key]['title'] = $value['nama_kegiatan'];
				$this->data['jadwal_kegiatan'][$key]['start'] = $value['tgl_mulai'];
				$this->data['jadwal_kegiatan'][$key]['end'] = $value['tgl_selesai'];
			}
		} else {
			$this->data['jadwal_kegiatan'] = '';
		}

		// Section galeri
		$galeriKegiatan = $this->galeriKegiatanModel->getGaleri(10);
		$this->data['galeri_kegiatan'] = $galeriKegiatan;

		return view('main/beranda/beranda.php', $this->data);
	}

	public function coba()
	{
		return view('coba.php');
	}
}
