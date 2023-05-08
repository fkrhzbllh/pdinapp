<?php
namespace App\Models;

class UserModel extends \App\Models\BaseModel
{
    protected $table = 'user';
    protected $useTimestamps = true;
    // protected $ruanganTable = 'ruangan';
    protected $allowedFields = ['email', 'nama', 'kontak', 'nama_instansi'];

    public function __construct()
    {
        parent::__construct();
        $this->table = 'user';
    }

    // public function getJadwalSewaRuangan($id)
    // {
    //     return $this->db->table('sewa_ruangan')
    //     ->join($this->ruanganTable,$this->ruanganTable.".".$this->primaryKey."=".$this->table.".id_ruangan")
    //     ->where($this->ruanganTable.".id",$id)->get()->getResultArray();
    // }
}