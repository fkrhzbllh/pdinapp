<?php
namespace App\Models;

class RuanganModel extends \App\Models\BaseModel
{
    protected $table = 'ruangan';
    protected $primaryKey = 'id';
    protected $useTimestamps = true;
    protected $tableSewaRuangan = 'sewa_ruangan';

    public function __construct()
    {
        parent::__construct();
        $this->table = 'ruangan';
        $this->primaryKey = 'id';
    }

    public function getRuangan($slug = false)
    {
        if (!$slug) 
        {
            return $this->findAll();
        }

        return $this->where(['slug' => $slug])->first();
    }

    public function getJadwalSewaRuangan($id)
    {
        return $this->db->table('sewa_ruangan')
        ->join($this->table,$this->table.".".$this->primaryKey."=".$this->tableSewaRuangan.".id_ruangan")
        ->where($this->table.".id",$id)->get()->getResultArray();
    }
}