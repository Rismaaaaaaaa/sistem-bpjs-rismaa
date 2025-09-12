<?php

namespace App\Models;

use CodeIgniter\Model;

class BubmModel extends Model
{
    protected $table      = 'bubm';          // nama tabel
    protected $primaryKey = 'id';            // primary key

    protected $useAutoIncrement = true;
    protected $returnType       = 'array';   // hasil query berupa array
    protected $useSoftDeletes   = false;

    protected $allowedFields = [
        'kode_transaksi',
        'voucher',
        'program',
        'jumlah_rupiah',
        'keterangan',
        'dokumen',
    ];

    // Timestamp (created_at, updated_at)
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at'; // optional kalau pakai soft delete

    // Validasi opsional
    protected $validationRules = [
        'kode_transaksi' => 'required|max_length[50]',
        'voucher'        => 'required|max_length[100]',
        'program'        => 'required|max_length[100]',
        'jumlah_rupiah'  => 'required|decimal',
        'keterangan'     => 'permit_empty|max_length[255]',
        'dokumen'        => 'permit_empty|uploaded[dokumen]|is_image[dokumen]|mime_in[dokumen,image/jpg,image/jpeg,image/png]',
    ];

    protected $validationMessages = [];
    protected $skipValidation     = false;
}
