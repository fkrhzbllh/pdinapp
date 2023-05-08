<?php
namespace App\Models;

class SewaRuanganModel extends \App\Models\BaseModel
{
    protected $table = 'sewa_ruangan';
    protected $useTimestamps = true;
    protected $ruanganTable = 'ruangan';
    protected $allowedFields = ['id_ruangan', 'nama_kegiatan', 'deskripsi', 'id_user', 'tipe', 'tgl_mulai_sewa', 'tgl_akhir_sewa', 'tgl_transaksi'];

    public function __construct()
    {
        parent::__construct();
        $this->table = 'sewa_ruangan';
    }

    public function getJadwalSewaRuangan($id)
    {
        return $this->db->table('sewa_ruangan')
        ->join($this->ruanganTable,$this->ruanganTable.".".$this->primaryKey."=".$this->table.".id_ruangan")
        ->where($this->ruanganTable.".id",$id)->get()->getResultArray();
    }
}