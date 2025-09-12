<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateJaminanTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'                => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nomor_penetapan'   => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'tanggal_transaksi' => [
                'type' => 'DATE',
            ],
            'kode_transaksi'    => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'nomor_kpj'         => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'nama_perusahaan'   => [
                'type'       => 'VARCHAR',
                'constraint' => 150,
            ],
            'pph21'             => [
                'type'       => 'DECIMAL',
                'constraint' => '15,2',
                'null'       => true,
            ],
            'jumlah_bayar'      => [
                'type'       => 'DECIMAL',
                'constraint' => '15,2',
            ],
            'no_rekening'       => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
            'atas_nama'         => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'dokumen'           => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true, 
            ],
            'created_at'        => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at'        => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('jaminan');
    }

    public function down()
    {
        $this->forge->dropTable('jaminan');
    }
}
