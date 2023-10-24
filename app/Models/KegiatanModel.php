<?php

namespace App\Models;

class KegiatanModel extends \App\Models\BaseModel
{
	protected $table = 'kegiatan';

	protected $useTimestamps = true;

	protected $allowedFields = ['nama_kegiatan', 'slug', 'jenis_kegiatan', 'tipe_kegiatan', 'tempat', 'tgl_mulai', 'tgl_selesai', 'link_pendaftaran', 'link_virtual', 'poster'];

	public function __construct()
	{
		parent::__construct();
		$this->table = 'kegiatan';
	}

	public function getKegiatan($slug = false)
	{
		if (!$slug) {
			return $this->findAll();
		}

		return $this->where(['slug' => $slug])->first();
	}

	public function getKegiatanByID($id)
	{
		return $this->where([$this->primaryKey => $id])->first();
	}

	public function getKegiatanTerakhir($jumlah = 5)
	{
		$kegiatan = $this->where('tgl_selesai <', date('Y-m-d H:i:s'))
			->orderBy('tgl_selesai', 'desc')
			->findAll($jumlah);

		foreach ($kegiatan as &$k) {
			// Create a new array key tgl_mulai_terformat and tgl_selesai_terformat containing formatted tgl_selesai and tgl_mulai
			$k['tgl_mulai_terformat'] = $this->formatTanggal($k['tgl_mulai']);
			$k['tgl_selesai_terformat'] = $this->formatTanggal($k['tgl_selesai']);
		}

		return $kegiatan;
	}

	public function getKegiatanMendatangAtauTerakhir()
	{
		$a = $this->where('tgl_mulai >', date('Y-m-d H:i:s'))
			->orderBy('tgl_mulai', 'asc')
			->first();

		if ($a == null) {
			$a = $this->where('tgl_selesai <', date('Y-m-d H:i:s'))
				->orderBy('tgl_selesai', 'desc')
				->first();
		}

		if ($a != null) {

			$tgl_mulai_unix = strtotime($a['tgl_mulai']);
			$tgl_selesai_unix = strtotime($a['tgl_selesai']);
			$now_unix = strtotime(date('Y-m-d H:i:s'));

			$diff_seconds = abs($tgl_mulai_unix - $now_unix);
			$diff_seconds_past = abs($tgl_selesai_unix - $now_unix);

			if ($now_unix > $tgl_selesai_unix) {
				// Event has already ended
				$remaining_days = floor($diff_seconds_past / (60 * 60 * 24));
				$a['hari_tersisa'] = $remaining_days . ' hari yang lalu';
			} else {
				// Event is in the future
				$remaining_days = floor($diff_seconds / (60 * 60 * 24));
				$a['hari_tersisa'] = $remaining_days . ' hari lagi';
			}

			// Create a new array key tgl_mulai_terformat and tgl_selesai_terformat containing formatted tgl_selesai and tgl_mulai
			$a['tgl_mulai_terformat'] = $this->formatTanggal($a['tgl_mulai']);
			$a['tgl_selesai_terformat'] = $this->formatTanggal($a['tgl_selesai']);
		}

		return $a;
	}

	public function formatTanggal($tanggal): string
	{

		// Define Indonesian month names
		$bulan = [
			1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
			5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
			9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
		];
		$tgl_unix = strtotime($tanggal);

		$tgl_terformat = date('d', $tgl_unix) . ' ' . $bulan[date('n', $tgl_unix)] . ' ' . date('Y', $tgl_unix);

		if (date('H:i', $tgl_unix) !== '00:00') {
			$tgl_terformat .= ' Pukul ' . date('H:i', $tgl_unix);
		}

		return $tgl_terformat;
	}
}
