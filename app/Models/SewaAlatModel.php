<?php

namespace App\Models;

class SewaAlatModel extends \App\Models\BaseModel
{
    protected $table = 'sewa_alat';
    protected $useTimestamps = true;
    protected $alatTable = 'alat';
    protected $allowedFields = ['uuid', 'id_alat', 'nama_kegiatan', 'deskripsi', 'id_penyewa', 'tipe', 'tgl_mulai_sewa', 'tgl_akhir_sewa', 'tgl_transaksi'];

    public function __construct()
    {
        parent::__construct();
        $this->table = 'sewa_alat';
    }

    /**
     * Memperoleh seluruh jadwal suatu alat
     * berdasarkan ID alat
     * 
     * @param string $id 
     * 
     */
    public function getJadwalSewaAlat($id)
    {
        return $this->db->table('sewa_alat')
            // ->join($this->alatTable,$this->alatTable.".".$this->primaryKey."=".$this->table.".id_alat")
            // ->where($this->alatTable.".id",$id)->get()->getResultArray();
            ->where(['id_alat' => $id])->get()->getResultArray();
    }

    public function getJadwalByID($id)
    {
        return $this->where([$this->primaryKey => $id])->first();
    }

    /**
     * Memperoleh jadwal sewa suatu alat berdasarkan UUID
     * 
     * @param string $uuid
     */
    public function getJadwalByUUID($uuid)
    {
        return $this->where(['uuid' => $uuid])->first();
    }
}
