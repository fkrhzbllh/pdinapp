<?php
namespace App\Models;

class RuanganModel extends \App\Models\BaseModel
{
    protected $table = 'ruangan';
    protected $primaryKey = 'id';
    protected $useTimestamps = true;

    public function __construct()
    {
        parent::__construct();
        $this->table = 'ruangan';
        $this->primaryKey = 'id';
    }
}