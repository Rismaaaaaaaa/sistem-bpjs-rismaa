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
        'nomor_rak',
        'nomor_baris',
        'tanggal_transaksi',
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
        'nomor_rak'      => 'permit_empty|max_length[50]',
        'nomor_baris'    => 'permit_empty|max_length[50]',
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

    protected $skipValidation = false;

    /**
     * Ambil data berdasarkan filter (search, date, sort)
     */
    public function getFilteredData($search = null, $date = 'all', $sortBy = 'newest')
    {
        $builder = $this->builder();

        // 🔎 Pencarian
        if (!empty($search)) {
            $builder->groupStart()
                ->like('kode_transaksi', $search)
                ->orLike('voucher', $search)
                ->orLike('program', $search)
            ->groupEnd();
        }

        // 📅 Filter tanggal
        switch ($date) {
            case 'today':
                $builder->where('DATE(tanggal_transaksi)', date('Y-m-d'));
                break;
            case 'week':
                $builder->where('YEARWEEK(tanggal_transaksi, 1)', date('oW'));
                break;
            case 'month':
                $builder->where('MONTH(tanggal_transaksi)', date('m'))
                        ->where('YEAR(tanggal_transaksi)', date('Y'));
                break;
            case 'year':
                $builder->where('YEAR(tanggal_transaksi)', date('Y'));
                break;
            default:
                // "all" → tanpa filter tanggal
                break;
        }

        // ↕️ Sorting
        switch ($sortBy) {
            case 'oldest':
                $builder->orderBy('tanggal_transaksi', 'ASC');
                break;
            case 'amount_desc':
                $builder->orderBy('jumlah_rupiah', 'DESC');
                break;
            case 'amount_asc':
                $builder->orderBy('jumlah_rupiah', 'ASC');
                break;
            default:
                $builder->orderBy('tanggal_transaksi', 'DESC'); // newest
                break;
        }

        return $builder->get()->getResultArray();
    }
}
