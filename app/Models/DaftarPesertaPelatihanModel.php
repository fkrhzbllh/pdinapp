<?php

namespace App\Models;

class DaftarPesertaPelatihanModel extends \App\Models\BaseModel
{
    protected $table = 'daftar_peserta_pelatihan';
    protected $useTimestamps = true;
    protected $allowedFields = ['id_peserta_pelatihan', 'id_pelatihan'];

    public function __construct()
    {
        parent::__construct();
        $this->table = 'daftar_peserta_pelatihan';
    }
}
