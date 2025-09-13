<?php

namespace App\Controllers;

use App\Models\BubmModel;
use CodeIgniter\I18n\Time;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Reader\Xls;


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

    public function create()
    {
        $data = [
            'title'       => 'Tambah BUBM',
            'active_menu' => 'bubm',
        ];

        return view('admin/tambah_bubm', $data);
    }

    public function store()
    {
        // Ambil nomor voucher
        $voucher = $this->request->getPost('voucher');

        // Buat kode transaksi otomatis
        $today          = date('d/m/Y');
        $kodeTransaksi  = $today . ' - ' . $voucher;

        // Upload dokumen
        $file     = $this->request->getFile('dokumen');
        $fileName = null;

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $fileName = $file->getRandomName();
            $file->move(WRITEPATH . 'uploads/bubm', $fileName); // → simpan di writable/uploads/bubm
        }

        // Simpan ke DB
        $this->bubmModel->save([
            'kode_transaksi' => $kodeTransaksi,
            'voucher'        => $voucher,
            'program'        => $this->request->getPost('program') ?? 'BUBM',
            'jumlah_rupiah'  => $this->request->getPost('jumlah_rupiah'),
            'keterangan'     => $this->request->getPost('keterangan'),
            'dokumen'        => $fileName,
        ]);

        return redirect()->to('/admin/bubm')->with('success', 'Data BUBM berhasil disimpan');
    }




    public function import_bubm()
    {
        $file = $this->request->getFile('file_excel');

        // Pastikan file ada
        if (!$file || !$file->isValid()) {
            return redirect()->back()->with('error', 'File tidak valid atau belum dipilih');
        }

        $ext = strtolower($file->getClientExtension());

        // Pilih reader sesuai ekstensi
        if ($ext === 'csv') {
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
        } elseif ($ext === 'xls') {
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
        } else {
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        }

        try {
            $spreadsheet = $reader->load($file->getTempName());
            $sheetData   = $spreadsheet->getActiveSheet()->toArray();

            $dataInsert = [];

            foreach ($sheetData as $index => $row) {
                if ($index == 0) continue; // skip header

                // ✅ handle tanggal (kolom ke-6 = index 6)
                $tanggal = date('Y-m-d H:i:s'); // default
                if (!empty($row[6])) {
                    if (is_numeric($row[6])) {
                        // Kalau Excel nyimpen tanggal sebagai serial number
                        $tanggal = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[6])
                            ->format('Y-m-d H:i:s');
                    } else {
                        // Kalau formatnya string (mis: 2025-09-13 atau 13/09/2025)
                        $tanggal = date('Y-m-d H:i:s', strtotime($row[6]));
                    }
                }

                $dataInsert[] = [
                    'kode_transaksi'    => $row[0] ?? null,
                    'voucher'           => $row[1] ?? null,
                    'program'           => !empty($row[2]) ? $row[2] : 'BUBM',
                    'jumlah_rupiah'     => !empty($row[3]) ? (float) str_replace([',', '.'], '', $row[3]) : 0,
                    'keterangan'        => $row[4] ?? null,
                    'dokumen'           => $row[5] ?? null,
                    'tanggal_transaksi' => $tanggal,
                    'created_at'        => date('Y-m-d H:i:s'),
                    'updated_at'        => date('Y-m-d H:i:s'),
                ];
            }

            if (!empty($dataInsert)) {
                $this->bubmModel->insertBatch($dataInsert);
                return redirect()->to('/admin/bubm')->with('success', 'Data BUBM berhasil diimport!');
            }

            return redirect()->back()->with('error', 'Tidak ada data yang bisa diimport');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal membaca file: ' . $e->getMessage());
        }
    }


}
