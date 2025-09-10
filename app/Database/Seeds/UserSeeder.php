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
                'password' => password_hash('admin123', PASSWORD_DEFAULT),
                'role' => 'admin'
            ],
            [
                'username' => 'superadmin1',
                'password' => password_hash('super123', PASSWORD_DEFAULT),
                'role' => 'super_admin'
            ],
        ];

        $this->db->table('users')->insertBatch($data);
    }
}
