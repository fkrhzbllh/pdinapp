<?php

namespace App\Models;

class PenyewaModel extends \App\Models\BaseModel
{
	protected $table = 'penyewa';

	protected $useTimestamps = true;

	// protected $ruanganTable = 'ruangan';
	protected $allowedFields = ['id_user', 'uuid', 'email', 'nama', 'kontak', 'nama_instansi'];

	public function __construct()
	{
		parent::__construct();
		$this->table = 'penyewa';
	}

	public function getPenyewaByID($id)
	{
		return $this->where([$this->primaryKey => $id])->first();
	}

	public function getUserByEmail($email)
	{
		return $this->where(['email' => $email])->first();
	}
}
