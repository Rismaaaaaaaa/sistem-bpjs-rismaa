<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'username' => 'admin1',
                'email'    => 'admin1@example.com',
                'password' => password_hash('admin123', PASSWORD_DEFAULT),
                'role'     => 'admin'
            ],
            [
                'username' => 'superadmin1',
                'email'    => 'superadmin1@example.com',
                'password' => password_hash('super123', PASSWORD_DEFAULT),
                'role'     => 'superadmin'
            ],
        ];

        $this->db->table('users')->insertBatch($data);
    }
}
