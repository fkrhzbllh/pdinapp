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
}
