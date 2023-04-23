<?php
namespace App\Models;

class KegiatanModel extends \App\Models\BaseModel
{
    protected $table = 'kegiatan';
    protected $primaryKey = 'id_kegiatan';
    protected $useTimestamps = true;
    public function __construct()
    {
        parent::__construct();
        $this->table = 'kegiatan';
        $this->primaryKey = 'id_kegiatan';
    }
}