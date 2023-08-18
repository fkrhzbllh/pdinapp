<?php

namespace App\Models;

class ArtikelModel extends \App\Models\BaseModel
{
	protected $table = 'artikel';

	protected $useTimestamps = true;

	// protected $tableSewaRuangan = 'sewa_ruangan';
	protected $allowedFields = ['judul', 'slug', 'konten', 'excerp', 'meta_description', 'status', 'tgl_terbit', 'id_admin_create', 'id_admin_update', 'featured_image', 'kategori'];

	public function __construct()
	{
		parent::__construct();
		$this->table = 'artikel';
	}

	public function getArtikel($slug = false)
	{
		if (!$slug) {
			// Ambil semua artikel dan urutkan dari yang terbaru
			return $this->formatTanggal(
				$this->orderBy('tgl_terbit', 'DESC')->findAll()
			);
		}

		return $this->formatTanggal(
			$this->where(['slug' => $slug])->first()
		);
	}

	/**
	 * Ambil artikel spesifik berdasarkan ID
	 * $id = ID artikel
	 */
	public function getArtikelByID($id)
	{
		return $this->formatTanggal($this->where([$this->primaryKey => $id])->first());
	}

	/**
	 * Ambil artikel terbaru sebanyak $jumlah.
	 * $jumlah = jumlah artikel yang ingin diambil
	 */
	public function getArtikelTerbaru($jumlah)
	{
		$data = $this->orderBy('tgl_terbit', 'DESC') // Urutkan dari tanggal terbaru
			->findAll($jumlah);

		return $this->formatTanggal($data);
	}

	/**
	 * Ambil artikel pilihan yang dipilih secara random sebanyak $jumlah dalam $bulan bulan terakhir.
	 * $jumlah = banyaknya artikel yang akan diambil
	 * $bulan = berapa bulan terakhir
	 */
	public function getArtikelPilihan($jumlah, $bulan)
	{
		// Y bulan terakhir dalam bentuk Date agar bisa dicompare di query
		$lastYMonths = date('Y-m-d', strtotime("-$bulan months"));

		$data = $this->where("tgl_terbit >= '$lastYMonths'") // Jika tanggal terbit lebih besar dari Y bulan terakhir
			->orderBy('RAND()') // Urutkan secara random
			->findAll($jumlah); // Ambil sejumlah $jumlah data

		return $this->formatTanggal($data);
	}

	public function formatTanggal($data)
	{

		foreach ($data as &$item) {
			$timestamp = strtotime($item['tgl_terbit']); // Ubah ke timestamp

			$bulan_indonesia = array(
				1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April', 5 => 'Mei', 6 => 'Juni',
				7 => 'Juli', 8 => 'Agustus', 9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
			);

			$item['tgl_terbit_terformat'] = date('d', $timestamp) . ' ' . $bulan_indonesia[date('n', $timestamp)] . ' ' . date('Y', $timestamp);
		}
		return $data;
	}

	public function search($keyword)
	{
		return $this->table('artikel')->like('judul', $keyword);
	}
}
