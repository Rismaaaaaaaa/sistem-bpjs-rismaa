<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table      = 'users';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'username', 'email', 'password', 'role',
        'alamat', 'no_hp', 'jenis_kelamin', 'tanggal_lahir',
        'created_at', 'updated_at'
    ];

    protected $useTimestamps = true; // otomatis created_at & updated_at
}
