<?php

namespace App\Models;

use CodeIgniter\Model;

class BubmModel extends Model
{
    protected $table      = 'bubm';          
    protected $primaryKey = 'id';            

    protected $useAutoIncrement = true;
    protected $returnType       = 'array';   
    protected $useSoftDeletes   = false;

    protected $allowedFields = [
    'kode_transaksi',
    'voucher',
    'program',
    'jumlah_rupiah',
    'keterangan',
    'dokumen',
    'tanggal_transaksi', // ✅ tambahin ini
    'created_at',
    'updated_at'
    ];


    // Timestamp
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Validasi
    protected $validationRules = [
        'kode_transaksi' => 'required|max_length[255]',
        'voucher'        => 'required|max_length[100]',
        'program'        => 'required|max_length[100]',
        'jumlah_rupiah'  => 'required|decimal',
        'keterangan'     => 'permit_empty|string',
        'dokumen'        => 'permit_empty|max_length[255]',
    ];

    protected $validationMessages = [
        'kode_transaksi' => [
            'required' => 'Kode transaksi wajib diisi.'
        ],
        'voucher' => [
            'required' => 'Nomor voucher wajib diisi.'
        ],
        'program' => [
            'required' => 'Program wajib dipilih.'
        ],
        'jumlah_rupiah' => [
            'required' => 'Jumlah rupiah wajib diisi.',
            'decimal'  => 'Jumlah rupiah harus berupa angka desimal.'
        ],
    ];

    protected $skipValidation     = false;
}
