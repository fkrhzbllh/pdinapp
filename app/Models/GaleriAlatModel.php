<?php

namespace App\Models;

class GaleriAlatModel extends \App\Models\BaseModel
{
	protected $table = 'galeri_alat';

	protected $useTimestamps = true;

	protected $tableAlat = 'alat';

	protected $allowedFields = ['nama_file', 'id_alat', 'judul', 'kategori'];

	public function __construct()
	{
		parent::__construct();
		$this->table = 'galeri_alat';
	}

	public function getGaleriByAlat($id)
	{
		return $this->db->table('galeri_alat')
		->join($this->tableAlat, $this->tableAlat . '.' . $this->primaryKey . '=' . $this->table . '.id_alat')
		->where($this->tableAlat . '.id', $id)->get()->getResultArray();
	}
}
