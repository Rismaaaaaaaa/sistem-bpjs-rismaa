<?php

namespace App\Controllers;

use App\Models\BubmModel;
use CodeIgniter\I18n\Time;

class BubmController extends BaseController
{
    protected $bubmModel;

    public function __construct()
    {
        $this->bubmModel = new BubmModel();
    }

    public function index()
    {
        $search = $this->request->getGet('search');
        $date   = $this->request->getGet('date') ?? 'all';
        $sortBy = $this->request->getGet('sortBy') ?? 'newest';

        $query = $this->bubmModel;

        // 🔍 Search
        if (!empty($search)) {
            $query = $query->groupStart()
                ->like('kode_transaksi', $search)
                ->orLike('voucher', $search)
                ->orLike('program', $search)
                ->groupEnd();
        }

        // 📅 Filter Tanggal
        if ($date !== 'all') {
            $today = new Time('now', 'Asia/Jakarta');

            switch ($date) {
                case 'today':
                    $query = $query->where('DATE(created_at)', $today->toDateString());
                    break;
                case 'week':
                    $query = $query->where('YEARWEEK(created_at)', $today->format('oW'));
                    break;
                case 'month':
                    $query = $query->where('MONTH(created_at)', $today->getMonth())
                                   ->where('YEAR(created_at)', $today->getYear());
                    break;
                case 'year':
                    $query = $query->where('YEAR(created_at)', $today->getYear());
                    break;
            }
        }

        // 🔄 Sorting
        switch ($sortBy) {
            case 'oldest':
                $query = $query->orderBy('created_at', 'ASC');
                break;
            case 'amount_desc':
                $query = $query->orderBy('jumlah_rupiah', 'DESC');
                break;
            case 'amount_asc':
                $query = $query->orderBy('jumlah_rupiah', 'ASC');
                break;
            default: // newest
                $query = $query->orderBy('created_at', 'DESC');
        }

        $bubm = $query->findAll();

        // Stats
        $totalData   = count($bubm);
        $totalRupiah = array_sum(array_column($bubm, 'jumlah_rupiah'));

        $data = [
            'title'        => 'Data BUBM',
            'active_menu'  => 'bubm',
            'bubm'         => $bubm,
            'totalData'    => $totalData,
            'totalRupiah'  => $totalRupiah,
            'search'       => $search,
            'date'         => $date,
            'sortBy'       => $sortBy,
        ];

        return view('admin/bubm', $data);
    }

    public function import_bubm()
    {
        $file = $this->request->getFile('file_excel');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $ext = $file->getClientExtension();

            if (in_array($ext, ['xls', 'xlsx', 'csv'])) {
                // TODO: proses import Excel pake PHPSpreadsheet
                // buat dummy dulu
                return redirect()->back()->with('success', 'File berhasil diupload (belum diproses)');
            } else {
                return redirect()->back()->with('error', 'Format file tidak didukung');
            }
        }
        return redirect()->back()->with('error', 'Upload file gagal');
    }
}
