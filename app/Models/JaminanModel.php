<?php

namespace App\Models;

use CodeIgniter\Model;

class JaminanModel extends Model
{
    protected $table = 'jaminan';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'nomor_penetapan',
        'tanggal_transaksi',
        'kode_transaksi',
        'nomor_kpj',
        'nama_perusahaan',
        'pph21',
        'jumlah_bayar',
        'no_rekening',
        'atas_nama',
        'dokumen',
    ];
    protected $useTimestamps = true; // supaya created_at & updated_at otomatis keisi
}
