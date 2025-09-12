<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class BubmSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'kode_transaksi' => '02/01/2012',
                'voucher'        => 'RB018 02',
                'program'        => 'BUBM',
                'jumlah_rupiah'  => 10000000.00,
                'keterangan'     => 'Pencairan Uang Kas',
                'dokumen'        => '1 BERKAS - ASLI',
            ],
            [
                'kode_transaksi' => '02/01/2012',
                'voucher'        => 'RB018 03',
                'program'        => 'BUBM',
                'jumlah_rupiah'  => 515000.00,
                'keterangan'     => 'Dengan CEK FH 505591 fasilitas rumah jabatan Kabid AM Mulyadi bulan Januari 2012',
                'dokumen'        => '1 BERKAS - ASLI',
            ],
            [
                'kode_transaksi' => '02/01/2012',
                'voucher'        => 'RB018 04',
                'program'        => 'BUBM',
                'jumlah_rupiah'  => 715000.00,
                'keterangan'     => 'Dengan CEK FH 505591 fasilitas rumah jabatan Kabid AN Jalilani bulan Januari 2012',
                'dokumen'        => '1 BERKAS - ASLI',
            ],
            [
                'kode_transaksi' => '02/01/2012',
                'voucher'        => 'RB018 05',
                'program'        => 'BUBM',
                'jumlah_rupiah'  => 715000.00,
                'keterangan'     => 'Dengan CEK FH 505591 fasilitas rumah jabatan Kabid AN Eliana Sunarda bulan Januari 2012',
                'dokumen'        => '1 BERKAS - ASLI',
            ],
        ];

        $this->db->table('bubm')->insertBatch($data);
    }
}
