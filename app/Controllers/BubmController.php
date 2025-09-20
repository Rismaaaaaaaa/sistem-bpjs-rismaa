<?php

namespace App\Controllers;

use App\Models\BubmModel;
use CodeIgniter\I18n\Time;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Reader\Xls;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

use App\Controllers\BaseController;
use App\Models\BubmDokumenModel;

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

        if (!empty($search)) {
            $query = $query->groupStart()
                ->like('kode_transaksi', $search)
                ->orLike('voucher', $search)
                ->orLike('program', $search)
                ->groupEnd();
        }

        if ($date !== 'all') {
            $today = date('Y-m-d');
            if ($date === 'today') {
                $query = $query->where('DATE(tanggal_transaksi)', $today);
            } elseif ($date === 'week') {
                $query = $query->where('YEARWEEK(tanggal_transaksi, 1)', date('oW'));
            } elseif ($date === 'month') {
                $query = $query->where('MONTH(tanggal_transaksi)', date('m'))
                               ->where('YEAR(tanggal_transaksi)', date('Y'));
            } elseif ($date === 'year') {
                $query = $query->where('YEAR(tanggal_transaksi)', date('Y'));
            }
        }

        switch ($sortBy) {
            case 'oldest':
                $query = $query->orderBy('tanggal_transaksi', 'ASC');
                break;
            case 'amount_desc':
                $query = $query->orderBy('jumlah_rupiah', 'DESC');
                break;
            case 'amount_asc':
                $query = $query->orderBy('jumlah_rupiah', 'ASC');
                break;
            default:
                $query = $query->orderBy('tanggal_transaksi', 'DESC');
        }

        $bubm = $query->findAll();

        // Ambil dokumen untuk tiap transaksi
        $dokumenModel = new BubmDokumenModel();
        foreach ($bubm as &$row) {
            $row['dokumen_list'] = $dokumenModel->where('bubm_id', $row['id'])->findAll();
        }

        // Hitung total rupiah
        $totalRupiah = !empty($bubm)
            ? array_sum(array_map(fn($r) => (float)($r['jumlah_rupiah'] ?? 0), $bubm))
            : 0;

        $data = [
            'title'       => 'Data BUBM',
            'active_menu' => 'bubm',
            'bubm'        => $bubm,
            'totalData'   => count($bubm),
            'totalRupiah' => $totalRupiah,
            'search'      => $search,
            'date'        => $date,
            'sortBy'      => $sortBy,
        ];

        return view('admin/bubm', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Bubm',
            'active_menu' => 'bubm',
        ];

        return view('/admin/tambah_bubm', $data);
    }


    public function exportExcel()
    {
        $search = $this->request->getGet('search');
        $date   = $this->request->getGet('date') ?? 'all';
        $sortBy = $this->request->getGet('sortBy') ?? 'newest';

        // Ambil data pake model + filter
        $bubm = $this->bubmModel->getFilteredData($search, $date, $sortBy);

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Header Excel
        $headers = [
            'A1' => 'Kode Transaksi',
            'B1' => 'Voucher',
            'C1' => 'Tanggal Transaksi',
            'D1' => 'Program',
            'E1' => 'Nomor Rak',
            'F1' => 'Nomor Baris',
            'G1' => 'Jumlah Rupiah',
            'H1' => 'Keterangan',
            'I1' => 'Dokumen',
        ];
        foreach ($headers as $col => $text) {
            $sheet->setCellValue($col, $text);
        }

        // Isi data
        $row = 2;
        foreach ($bubm as $item) {
            $sheet->setCellValue('A' . $row, $item['kode_transaksi']);
            $sheet->setCellValue('B' . $row, $item['voucher']);
            $sheet->setCellValue('C' . $row, $item['tanggal_transaksi']);
            $sheet->setCellValue('D' . $row, $item['program']);
            $sheet->setCellValue('E' . $row, $item['nomor_rak']);
            $sheet->setCellValue('F' . $row, $item['nomor_baris']);
            $sheet->setCellValue('G' . $row, $item['jumlah_rupiah']);
            $sheet->setCellValue('H' . $row, $item['keterangan']);
            $sheet->setCellValue('I' . $row, $item['dokumen']);
            $row++;
        }

        // Download response
        $writer = new Xlsx($spreadsheet);
        $filename = 'data_bubm_' . date('Ymd_His') . '.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment;filename=\"$filename\"");
        header('Cache-Control: max-age=0');

        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        $writer->save('php://output');

        exit;
    }
}