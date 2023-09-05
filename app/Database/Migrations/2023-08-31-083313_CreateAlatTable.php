<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateAlatTable extends Migration
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
            'nama' => [
                'type' => 'varchar',
                'constraint' => 255,
                'null' => true,
            ],
            'slug' => [
                'type' => 'varchar',
                'constraint' => 255,
            ],
            'deskripsi' => [
                'type' => 'text',
                'null' => true,
            ],
            'biaya_sewa' => [
                'type' => 'int',
                'constraint' => 10,
                'unsigned' => true,
                'null' => true,
            ],
            'id_admin_create' => [
                'type' => 'int',
                'constraint' => 10,
                'unsigned' => true,
                'null' => true,
            ],
            'created_at' => [
                'type' => 'date',
                'null' => true,
            ],
            'id_admin_update' => [
                'type' => 'int',
                'constraint' => 10,
                'unsigned' => true,
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'date',
                'null' => true,
            ],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('alat');
    }

    public function down()
    {
        $this->forge->dropTable('alat');
    }
}
