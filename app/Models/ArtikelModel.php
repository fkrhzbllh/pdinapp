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
			return $this->findAll();
		}

		return $this->where(['slug' => $slug])->first();
	}

	public function getArtikelByID($id)
	{
		return $this->where([$this->primaryKey => $id])->first();
	}

	public function search($keyword)
	{
		return $this->table('artikel')->like('judul', $keyword);
	}
}
