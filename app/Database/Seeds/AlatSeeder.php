<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AlatSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'id' => 6,
                'nama' => 'Printer 3D',
                'slug' => 'Printer-3D',
                'deskripsi' => 'Printer 3D',
                'biaya_sewa' => 50000,
                'id_admin_create' => null,
                'created_at' => '2023-05-30',
                'id_admin_update' => null,
                'updated_at' => '2023-08-24',
            ],
            [
                'id' => 7,
                'nama' => 'Pemotong Logam',
                'slug' => 'pemotong-logam',
                'deskripsi' => 'Pemotong Logam',
                'biaya_sewa' => 0,
                'id_admin_create' => null,
                'created_at' => '2023-05-30',
                'id_admin_update' => null,
                'updated_at' => '2023-05-30',
            ],
            [
                'id' => 8,
                'nama' => 'Pemotong Kayu',
                'slug' => 'pemotong-kayu',
                'deskripsi' => 'Pemotong kayu',
                'biaya_sewa' => 0,
                'id_admin_create' => null,
                'created_at' => '2023-05-30',
                'id_admin_update' => null,
                'updated_at' => '2023-05-30',
            ],
        ];

        // Insert data
        $this->db->table('alat')->insertBatch($data);
    }
}
