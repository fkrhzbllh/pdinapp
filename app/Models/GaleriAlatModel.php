<?php

namespace App\Models;

class GaleriAlatModel extends \App\Models\BaseModel
{
	protected $table = 'galeri_alat';

	protected $useTimestamps = true;

	protected $tableAlat = 'alat';

	protected $tableGaleri = 'galeri';

	protected $allowedFields = ['id_galeri', 'id_alat'];

	public function __construct()
	{
		parent::__construct();
		$this->table = 'galeri_alat';
	}

	public function findGaleriAlat($idAlat)
	{
		return $this->where(['id_alat' => $idAlat])->get()->getResultArray();
	}

	public function getGaleriByAlat($id)
	{
		return $this->db->table('galeri_alat')
		->join($this->tableGaleri, $this->tableGaleri . '.' . $this->primaryKey . '=' . $this->table . '.id_galeri')
		->where($this->table . '.id_alat', $id)->get()->getResultArray();
	}

	public function getFirstGaleriByAlat($id)
	{
		return $this->db->table('galeri_alat')
		->join($this->tableGaleri, $this->tableGaleri . '.' . $this->primaryKey . '=' . $this->table . '.id_galeri')
		->where($this->table . '.id_alat', $id)->get()->getResult();
	}
}
