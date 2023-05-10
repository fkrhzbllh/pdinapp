<?php
namespace App\Models;

class GaleriRuanganModel extends \App\Models\BaseModel
{
    protected $table = 'galeri_ruangan';
    protected $useTimestamps = true;
    protected $tableRuangan = 'ruangan';
    protected $allowedFields = ['nama_file', 'id_ruangan'];

    public function __construct()
    {
        parent::__construct();
        $this->table = 'galeri_ruangan';
    }

    public function getGaleriByRuangan($id)
    {
        return $this->db->table('galeri_ruangan')
        ->join($this->tableRuangan,$this->tableRuangan.".".$this->primaryKey."=".$this->table.".id_ruangan")
        ->where($this->tableRuangan.".id",$id)->get()->getResultArray();
    }
}