<?php

namespace App\Models;

class PelatihanModel extends \App\Models\BaseModel
{
    protected $table = 'pelatihan';
    protected $useTimestamps = true;
    protected $tablePeserta = 'peserta_pelatihan';
    protected $allowedFields = ['uuid', 'nama_pelatihan', 'deskripsi_pelatihan', 'slug', 'tgl_mulai', 'tgl_selesai', 'waktu_mulai', 'waktu_selesai'];

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
    public function findByUUID($uuid)
    {
        return $this->where('uuid = "' . $uuid . '"')->first();
    }

    // public function getJadwalSewaAlat($id)
    // {
    //     return $this->db->table('sewa_alat')
    //     ->join($this->table,$this->table.".".$this->primaryKey."=".$this->tableSewaAlat.".id_alat")
    //     ->where($this->table.".id",$id)->get()->getResultArray();
    // }
}
