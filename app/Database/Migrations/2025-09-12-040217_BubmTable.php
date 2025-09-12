<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateBubmTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'auto_increment' => true,
            ],
            'kode_transaksi' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => false,
            ],
            'voucher' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => false,
            ],
            'program' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => false,
            ],
            'jumlah_rupiah' => [
                'type'       => 'DECIMAL',
                'constraint' => '15,2',
                'null'       => false,
            ],
            'keterangan' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'dokumen' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
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
        $this->forge->createTable('bubm', true);
    }

    public function down()
    {
        $this->forge->dropTable('bubm', true);
    }
}
