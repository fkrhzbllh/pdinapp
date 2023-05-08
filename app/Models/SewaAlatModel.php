<?php
namespace App\Models;

class SewaAlatModel extends \App\Models\BaseModel
{
    protected $table = 'sewa_alat';
    protected $useTimestamps = true;
    protected $alatTable = 'alat';
    protected $allowedFields = ['id_alat', 'nama_kegiatan', 'deskripsi', 'id_user', 'tipe', 'tgl_mulai_sewa', 'tgl_akhir_sewa', 'tgl_transaksi'];

    public function __construct()
    {
        parent::__construct();
        $this->table = 'sewa_alat';
    }

    public function getJadwalSewaAlat($id)
    {
        return $this->db->table('sewa_alat')
        ->join($this->alatTable,$this->alatTable.".".$this->primaryKey."=".$this->table.".id_alat")
        ->where($this->alatTable.".id",$id)->get()->getResultArray();
    }
}