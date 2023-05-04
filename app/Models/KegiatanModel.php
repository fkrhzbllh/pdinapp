<?php
namespace App\Models;

class KegiatanModel extends \App\Models\BaseModel
{
    protected $table = 'kegiatan';
    protected $useTimestamps = true;
    public function __construct()
    {
        parent::__construct();
        $this->table = 'kegiatan';
    }
}