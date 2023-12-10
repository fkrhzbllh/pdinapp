<?php

namespace App\Models;

class SewaRuanganModel extends \App\Models\BaseModel
{
	protected $table = 'sewa_ruangan';

	protected $useTimestamps = true;

	protected $ruanganTable = 'ruangan';

	protected $allowedFields = ['uuid', 'id_ruangan', 'nama_kegiatan', 'deskripsi', 'id_penyewa', 'tipe', 'tgl_mulai_sewa', 'tgl_akhir_sewa', 'tgl_transaksi'];

	public function __construct()
	{
		parent::__construct();
		$this->table = 'sewa_ruangan';
	}

	public function getJadwalSewaRuangan($id)
	{
		return $this->db->table('sewa_ruangan')
			// ->join($this->ruanganTable, $this->ruanganTable . '.' . $this->primaryKey . '=' . $this->table . '.id_ruangan')
			// ->where($this->ruanganTable . '.id', $id)->get()->getResultArray();
			->where(['id_ruangan' => $id])->get()->getResultArray();
	}

	public function getJadwalByID($id)
	{
		return $this->where([$this->primaryKey => $id])->first();
	}

	public function getJadwalByUUID($uuid)
	{
		return $this->where(['uuid' => $uuid])->first();
	}
}
