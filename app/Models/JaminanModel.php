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
        'nama_tenaga_kerja',
        'pph21',
        'nomor_rak',
        'nomor_baris',
        'jumlah_bayar',
        'no_rekening',
        'atas_nama',
    ];
    protected $useTimestamps = true; // otomatis isi created_at & updated_at

    public function getFilteredData($search = null, $date = 'all', $sortBy = 'newest')
    {
        $builder = $this->builder();

        // search
        if (!empty($search)) {
            $builder->groupStart()
                    ->like('nomor_penetapan', $search)
                    ->orLike('nomor_kpj', $search)
                    ->groupEnd();
        }

        // filter tanggal
        if ($date == 'today') {
            $builder->where('DATE(tanggal_transaksi)', date('Y-m-d'));
        } elseif ($date == 'week') {
            $builder->where('YEARWEEK(tanggal_transaksi, 1)', date('oW'));
        } elseif ($date == 'month') {
            $builder->where('MONTH(tanggal_transaksi)', date('m'))
                    ->where('YEAR(tanggal_transaksi)', date('Y'));
        } elseif ($date == 'year') {
            $builder->where('YEAR(tanggal_transaksi)', date('Y'));
        }

        // sorting
        if ($sortBy == 'newest') {
            $builder->orderBy('tanggal_transaksi', 'DESC');
        } elseif ($sortBy == 'oldest') {
            $builder->orderBy('tanggal_transaksi', 'ASC');
        } elseif ($sortBy == 'amount_desc') {
            $builder->orderBy('jumlah_bayar', 'DESC');
        } elseif ($sortBy == 'amount_asc') {
            $builder->orderBy('jumlah_bayar', 'ASC');
        }

        return $builder->get()->getResultArray();
    }
}
