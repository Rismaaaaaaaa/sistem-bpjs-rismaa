<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'username'      => 'Admin',
                'email'         => 'admin@gmail.com',
                'password'      => password_hash('password123', PASSWORD_DEFAULT),
                'role'          => 'admin',
                'alamat'        => 'Jl. Merdeka No. 123, Jakarta',
                'no_hp'         => '081234567890',
                'jenis_kelamin' => 'Laki-laki',
                'tanggal_lahir' => '1995-05-15',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'username'      => 'Super Admin',
                'email'         => 'superadmin@gmail.com',
                'password'      => password_hash('password123', PASSWORD_DEFAULT),
                'role'          => 'superadmin',
                'alamat'        => 'Jl. Sudirman No. 45, Bandung',
                'no_hp'         => '082345678901',
                'jenis_kelamin' => 'Perempuan',
                'tanggal_lahir' => '1990-10-20',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('users')->insertBatch($data);
    }
}
