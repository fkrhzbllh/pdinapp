<?php

namespace App\Models;

class ArtikelModel extends \App\Models\BaseModel
{
	protected $table = 'artikel';

	protected $useTimestamps = true;

	// protected $tableSewaRuangan = 'sewa_ruangan';
	protected $allowedFields = ['judul', 'slug', 'konten', 'excerp', 'status', 'tgl_terbit', 'id_admin_create', 'id_admin_update', 'featured_image', 'kategori'];

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
				// $this->where(['status' => 'published'])->where('tgl_terbit <= ', date('Y-m-d H:i:s'))->orderBy('tgl_terbit', 'DESC')->findAll()
				$this->db->table('artikel')->where(['status' => 'published'])->where('tgl_terbit <= ', date('Y-m-d H:i:s'))->orderBy('tgl_terbit', 'DESC')->get()->getResultArray()
			);
		}

		return $this->formatTanggalSingle(
			// $this->where(['slug' => $slug])->first()
			$this->db->table('artikel')->where('tgl_terbit <= ', date('Y-m-d H:i:s'))->where(['slug' => $slug])->get()->getFirstRow()
		);
	}

	/**
	 * Ambil artikel spesifik berdasarkan ID
	 * @param id ID artikel
	 */
	public function getArtikelByID($id)
	{
		return $this->formatTanggalSingle($this->where([$this->primaryKey => $id])->first());
	}

	/**
	 * Ambil artikel terbaru sebanyak $jumlah.
	 * @param jumlah berapa artikel yang ingin diambil
	 */
	public function getArtikelTerbaru($jumlah)
	{
		// $data = $this->where(['status' => 'published'])->orderBy('tgl_terbit', 'DESC') // Urutkan dari tanggal terbaru
		// 	->findAll($jumlah);
		$data = $this->db->table('artikel')->where('tgl_terbit <= ', date('Y-m-d H:i:s'))->where(['status' => 'published'])->orderBy('tgl_terbit', 'DESC') // Urutkan dari tanggal terbaru
			->get($jumlah)->getResultArray();

		return $this->formatTanggal($data);
	}

	/**
	 * Ambil artikel pilihan yang dipilih secara random sebanyak $jumlah dalam $bulan bulan terakhir.
	 * @param jumlah berapa artikel yang akan diambil
	 * @param bulan berapa bulan terakhir
	 */
	public function getArtikelPilihan($jumlah, $bulan)
	{
		// Y bulan terakhir dalam bentuk Date agar bisa dicompare di query
		$lastYMonths = date('Y-m-d', strtotime("-$bulan months"));

		// $data = $this->where("tgl_terbit >= '$lastYMonths'")->where(['status' => 'published']) // Jika tanggal terbit lebih besar dari Y bulan terakhir
		// 	->orderBy('RAND()') // Urutkan secara random
		// 	->findAll($jumlah); // Ambil sejumlah $jumlah data
		$data = $this->db->table('artikel')->where("tgl_terbit >= '$lastYMonths'")->where('tgl_terbit <= ', date('Y-m-d H:i:s'))->where(['status' => 'published']) // Jika tanggal terbit lebih besar dari Y bulan terakhir
			->orderBy('RAND()') // Urutkan secara random
			->get($jumlah)->getResultArray(); // Ambil sejumlah $jumlah data

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

	public function formatTanggalSingle($data)
	{
		// tampilan error kalau tidak ada slug artikel yang ada di database
		if (empty($data)) {
			throw new \CodeIgniter\Exceptions\PageNotFoundException('Artikel tidak ditemukan.');
		}

		$timestamp = strtotime($data['tgl_terbit']); // Ubah ke timestamp

		$bulan_indonesia = array(
			1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April', 5 => 'Mei', 6 => 'Juni',
			7 => 'Juli', 8 => 'Agustus', 9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
		);

		$data['tgl_terbit_terformat'] = date('d', $timestamp) . ' ' . $bulan_indonesia[date('n', $timestamp)] . ' ' . date('Y', $timestamp);

		return $data;
	}



	public function search($keyword)
	{
		return $this->table('artikel')->like('judul', $keyword);
	}
}
