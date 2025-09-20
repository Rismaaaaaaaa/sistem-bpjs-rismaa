<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateBubmDokumenTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'         => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'bubm_id'    => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'file_name'  => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'file_path'  => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('bubm_id', 'bubm', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('bubm_dokumen');
    }

    public function down()
    {
        $this->forge->dropTable('bubm_dokumen');
    }
}
