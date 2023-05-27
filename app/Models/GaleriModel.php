<?php

namespace App\Models;

class GaleriModel extends \App\Models\BaseModel
{
	protected $table = 'galeri';

	protected $useTimestamps = true;

	// protected $tableGaleriAlat = 'galeri_alat';

	// protected $tableGaleriKegiatan = 'galeri_kegiatan';

	protected $allowedFields = ['nama_file', 'id_ruangan', 'judul', 'kategori'];

	public function __construct()
	{
		parent::__construct();
		$this->table = 'galeri';
	}

	// public function getGaleriByRuangan($id)
	// {
	// 	return $this->db->table('galeri_ruangan')
	// 	->join($this->tableRuangan, $this->tableRuangan . '.' . $this->primaryKey . '=' . $this->table . '.id_ruangan')
	// 	->where($this->tableRuangan . '.id', $id)->get()->getResultArray();
	// }

	public function search($keyword)
	{
		return $this->table('galeri')->like('judul', $keyword);
	}
}
