<?php

namespace App\Models;

class PesertaPelatihanModel extends \App\Models\BaseModel
{
    protected $table = 'peserta_pelatihan';
    protected $useTimestamps = true;
    protected $allowedFields = ['id_user', 'id_pelatihan'];

    public function __construct()
    {
        parent::__construct();
        $this->table = 'pelatihan';
    }

    public function getPelatihan($slug = false)
    {
        if (!$slug) {
            return $this->findAll();
            // return $this->join($this->tableSewaAlat,$this->tableSewaAlat.".id_ruangan=".$this->table.".".$this->primaryKey)->getResultArray();
        }

        return $this->where(['slug' => $slug])->first();
    }

    public function getPelatihanByID($id)
    {
        return $this->where([$this->primaryKey => $id])->first();
    }

    // public function getJadwalSewaAlat($id)
    // {
    //     return $this->db->table('sewa_alat')
    //     ->join($this->table,$this->table.".".$this->primaryKey."=".$this->tableSewaAlat.".id_alat")
    //     ->where($this->table.".id",$id)->get()->getResultArray();
    // }
}
