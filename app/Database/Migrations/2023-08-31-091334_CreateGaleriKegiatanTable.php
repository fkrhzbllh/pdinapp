<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateGaleriKegiatanTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'id_kegiatan' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
            'id_galeri' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'id_file_picker' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
            'id_admin_create' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'id_admin_update' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('id_kegiatan', 'kegiatan', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_galeri', 'galeri', 'id', 'CASCADE', 'CASCADE');

        $this->forge->createTable('galeri_kegiatan');
    }

    public function down()
    {
        $this->forge->dropTable('galeri_kegiatan');
    }
}
