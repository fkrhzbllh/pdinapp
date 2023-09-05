<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateGaleriTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'int',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'id_file_picker' => [
                'type' => 'int',
                'constraint' => 10,
                'unsigned' => true,
                'null' => true,
            ],
            'nama_file' => [
                'type' => 'varchar',
                'constraint' => 255,
                'null' => true,
            ],
            'judul' => [
                'type' => 'varchar',
                'constraint' => 255,
                'null' => true,
            ],
            'kategori' => [
                'type' => 'varchar',
                'constraint' => 255,
                'null' => true,
            ],
            'id_admin_create' => [
                'type' => 'int',
                'constraint' => 10,
                'unsigned' => true,
                'null' => true,
            ],
            'created_at' => [
                'type' => 'datetime',
                'null' => true,
            ],
            'id_admin_update' => [
                'type' => 'int',
                'constraint' => 10,
                'unsigned' => true,
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'datetime',
                'null' => true,
            ],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('galeri');
    }

    public function down()
    {
        $this->forge->dropTable('galeri');
    }
}
