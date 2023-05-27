<?php

namespace App\Models;

class GaleriRuanganModel extends \App\Models\BaseModel
{
	protected $table = 'galeri_ruangan';

	protected $useTimestamps = true;

	protected $tableRuangan = 'ruangan';

	protected $tableGaleri = 'galeri';

	protected $allowedFields = ['id_ruangan', 'id_galeri'];

	public function __construct()
	{
		parent::__construct();
		$this->table = 'galeri_ruangan';
	}

	public function findGaleriRuangan($idRuangan)
	{
		return $this->where(['id_ruangan' => $idRuangan])->get()->getResultArray();
	}

	public function getGaleriByRuanganOld($id)
	{
		return $this->db->table('galeri_ruangan')
		->join($this->tableRuangan, $this->tableRuangan . '.' . $this->primaryKey . '=' . $this->table . '.id_ruangan')
		->where($this->tableRuangan . '.id', $id)->get()->getResultArray();
	}

	public function getGaleriByRuangan($id)
	{
		return $this->db->table('galeri_ruangan')
		->join($this->tableGaleri, $this->tableGaleri . '.' . $this->primaryKey . '=' . $this->table . '.id_galeri')
		->where($this->table . '.id_ruangan', $id)->get()->getResultArray();
	}

	public function getFirstGaleriByRuangan($id)
	{
		return $this->db->table('galeri_ruangan')
		->join($this->tableGaleri, $this->tableGaleri . '.' . $this->primaryKey . '=' . $this->table . '.id_galeri')
		->where($this->table . '.id_ruangan', $id)->get()->getResult();
	}
}
