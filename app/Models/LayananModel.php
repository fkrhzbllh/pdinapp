<?php
namespace App\Models;

class LayananModel extends \App\Models\BaseModel
{
    protected $table = 'layanan';
    protected $useTimestamps = true;

    public function __construct()
    {
        parent::__construct();
        $this->table = 'layanan';
    }
}