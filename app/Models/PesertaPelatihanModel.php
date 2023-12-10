<?php

namespace App\Models;

class PesertaPelatihanModel extends \App\Models\BaseModel
{
    protected $table = 'peserta_pelatihan';
    protected $useTimestamps = true;
    protected $allowedFields = ['uuid', 'id_user', 'id_pelatihan', 'nama', 'kontak', 'email'];

    public function __construct()
    {
        parent::__construct();
        $this->table = 'peserta_pelatihan';
    }

    public function getPelatihan($slug = false)
    {
        if (!$slug) {
            return $this->findAll();
        }

        return $this->where(['slug' => $slug])->first();
    }

    public function getPelatihanByID($id)
    {
        return $this->where([$this->primaryKey => $id])->first();
    }

    public function findByUUID($id)
    {
        return $this->where(['uuid' => $id])->first();
    }

    public function getPesertaByIDPelatihan($id)
    {
        // return $this->where(['id_pelatihan' => $id])->findAll();
        return $this->db->query(
            'SELECT 
            pp.id as id_peserta_pelatihan, 
            pp.uuid as uuid_peserta_pelatihan, 
            pp.nama, 
            pp.email, 
            pp.kontak, 
            pp.id_user, 
            p.id as id_pelatihan,  
            p.uuid as uuid_pelatihan,  
            p.nama_pelatihan, 
            p.deskripsi_pelatihan, 
            p.tgl_mulai, 
            p.tgl_selesai, 
            p.waktu_mulai, 
            p.waktu_selesai 
            FROM daftar_peserta_pelatihan dpp 
            JOIN peserta_pelatihan pp ON pp.id = dpp.id_peserta_pelatihan 
            JOIN pelatihan p ON p.id = dpp.id_pelatihan
            WHERE dpp.id_pelatihan = "' . $id . '"'
        )->getResultArray();
    }
}
