<?php

namespace App\Models;

class GaleriKegiatanModel extends \App\Models\BaseModel
{
	protected $table = 'galeri_kegiatan';

	protected $useTimestamps = true;

	protected $tableKegiatan = 'kegiatan';

	protected $tableGaleri = 'galeri';

	protected $allowedFields = ['nama_file', 'id_kegiatan', 'judul', 'kategori'];

	public function __construct()
	{
		parent::__construct();
		$this->table = 'galeri_kegiatan';
	}

	public function getGaleriByKegiatan($id)
	{
		return $this->db->table('galeri_kegiatan')
			->join($this->tableKegiatan, $this->tableKegiatan . '.' . $this->primaryKey . '=' . $this->table . '.id_kegiatan')
			->where($this->tableKegiatan . '.id', $id)->get()->getResultArray();
	}

	public function getGaleri($jumlah = null)
	{
		return $this->db->table('galeri_kegiatan')
			->join($this->tableGaleri, $this->tableGaleri . '.' . $this->primaryKey . '=' . $this->table . '.id_galeri')
			->get($jumlah)->getResultArray();
	}
}
