<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class JaminanSeeder extends Seeder
{
    public function run()
    {
        $faker = \Faker\Factory::create('id_ID'); // pake locale Indonesia biar realistis

        $data = [];

        for ($i = 1; $i <= 30; $i++) {
            $data[] = [
                'nomor_penetapan'   => 'PN-' . str_pad($i, 4, '0', STR_PAD_LEFT),
                'tanggal_transaksi' => $faker->date('Y-m-d', 'now'),
                'kode_transaksi'    => strtoupper($faker->bothify('TRX-###??')),
                'nomor_kpj'         => $faker->numerify('KPJ#########'),
                'nama_perusahaan'   => $faker->company,
                'pph21'             => $faker->randomFloat(2, 50000, 2000000),
                'jumlah_bayar'      => $faker->randomFloat(2, 1000000, 50000000),
                'no_rekening'       => $faker->numerify('7###########'),
                'atas_nama'         => $faker->name,
                'dokumen'           => $faker->randomElement([
                    'dokumen1.png', 'dokumen2.jpg', 'dokumen3.png', null
                ]),
                'created_at'        => $faker->dateTimeThisYear()->format('Y-m-d H:i:s'),
                'updated_at'        => $faker->dateTimeThisYear()->format('Y-m-d H:i:s'),
            ];
        }

        // Insert ke tabel jaminan
        $this->db->table('jaminan')->insertBatch($data);
    }
}
