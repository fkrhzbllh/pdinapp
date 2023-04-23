<?php
namespace App\Models;

class LayananModel extends \App\Models\BaseModel
{
    protected $table = 'layanan';
    protected $primaryKey = 'id_layanan';
    protected $useTimestamps = true;

    public function __construct()
    {
        parent::__construct();
        $this->table = 'layanan';
        $this->primaryKey = 'id_layanan';
    }
}