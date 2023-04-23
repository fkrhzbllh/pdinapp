<?php
namespace App\Models;

class AlatModel extends \App\Models\BaseModel
{
    protected $table = 'alat';
    protected $primaryKey = 'id';
    protected $useTimestamps = true;

    public function __construct()
    {
        parent::__construct();
        $this->table = 'alat';
        $this->primaryKey = 'id';
    }
}