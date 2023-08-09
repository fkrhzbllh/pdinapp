<?php

namespace App\Models;

class UsersModel extends \App\Models\BaseModel
{
	protected $table = 'user';

	protected $useTimestamps = true;

	// protected $ruanganTable = 'ruangan';
	protected $allowedFields = ['email', 'nama', 'kontak', 'nama_instansi'];

	public function __construct()
	{
		parent::__construct();
		$this->table = 'user';
	}

	public function getUserByID($id)
	{
		return $this->where([$this->primaryKey => $id])->first();
	}
}
