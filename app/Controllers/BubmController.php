<?php

namespace App\Controllers;

use App\Models\BubmModel;
use App\Models\BubmDokumenModel;
use CodeIgniter\I18n\Time;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Reader\Xls;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

use App\Controllers\BaseController;

class BubmController extends BaseController
{
    protected $bubmModel;
    protected $bubmDokumenModel;

    public function __construct()
    {
        $this->bubmModel = new BubmModel();
        $this->bubmDokumenModel = new BubmDokumenModel();
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

    public function store()
    {
        // Validasi input
        $validationRules = [
            'voucher'       => 'required|min_length[3]|max_length[50]',
            'program'       => 'required|min_length[3]|max_length[100]',
            'jumlah_rupiah' => 'required|numeric|greater_than[0]',
            'tanggal_input' => 'required|valid_date',
            'nomor_rak'     => 'required|min_length[1]|max_length[20]',
            'nomor_baris'   => 'required|min_length[1]|max_length[20]',
            // dokumen tidak wajib, hanya validasi ukuran & ekstensi kalau ada
            'dokumen.*'     => 'if_exist|max_size[dokumen,5120]|ext_in[dokumen,png,jpg,jpeg]',
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Ambil data dari form
        $voucher       = $this->request->getPost('voucher');
        $program       = $this->request->getPost('program') === 'lainnya'
            ? $this->request->getPost('program_manual')
            : $this->request->getPost('program');
        $jumlahRupiah  = str_replace(',', '', $this->request->getPost('jumlah_rupiah'));
        $tanggalInput  = $this->request->getPost('tanggal_input');
        $nomorRak      = $this->request->getPost('nomor_rak');
        $nomorBaris    = $this->request->getPost('nomor_baris');
        $keterangan    = $this->request->getPost('keterangan');

        // Generate kode transaksi
        $kodeTransaksi = date('d/m/Y') . ' - ' . $voucher;

        // Simpan data BUBM
        $bubmData = [
            'kode_transaksi'    => $kodeTransaksi,
            'voucher'           => $voucher,
            'program'           => $program,
            'jumlah_rupiah'     => $jumlahRupiah,
            'tanggal_transaksi' => $tanggalInput,
            'nomor_rak'         => $nomorRak,
            'nomor_baris'       => $nomorBaris,
            'keterangan'        => $keterangan,
            'created_at'        => Time::now(),
            'updated_at'        => Time::now(),
        ];

        $bubmId = $this->bubmModel->insert($bubmData);

        if ($bubmId) {
            // Proses upload dokumen (jika ada)
            $files = $this->request->getFiles();
            if (!empty($files['dokumen'])) {
                foreach ($files['dokumen'] as $file) {
                    if ($file->isValid() && !$file->hasMoved()) {
                        $newName = $file->getRandomName();
                        $file->move(ROOTPATH . 'public/uploads/bubm', $newName);

                        $dokumenData = [
                            'bubm_id'   => $bubmId,
                            'file_name' => $newName,
                            'file_path' => 'uploads/bubm/' . $newName,
                            'file_type' => $file->getClientMimeType(),
                            'file_size' => $file->getSizeByUnit('kb'),
                            'created_at'=> Time::now(),
                        ];
                        $this->bubmDokumenModel->insert($dokumenData);
                    }
                }
            }

            return redirect()->to('/admin/bubm')->with('success', 'Data BUBM berhasil disimpan.');
        }

        return redirect()->back()->with('error', 'Gagal menyimpan data BUBM.');
    }


    public function import()
    {
        $file = $this->request->getFile('file_excel');

        if (!$file || !$file->isValid()) {
            return redirect()->back()->with('error', 'File tidak valid atau tidak ditemukan');
        }

        $ext = strtolower($file->getClientExtension());
        if (!in_array($ext, ['csv', 'xlsx'])) {
            return redirect()->back()->with('error', 'Format file tidak didukung. Gunakan CSV atau XLSX.');
        }

        try {
            $reader = $ext === 'csv'
                ? new \PhpOffice\PhpSpreadsheet\Reader\Csv()
                : new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();

            $spreadsheet = $reader->load($file->getTempName());
            $sheetData   = $spreadsheet->getActiveSheet()->toArray();

            if (empty($sheetData)) {
                return redirect()->back()->with('error', 'File kosong atau tidak terbaca');
            }

            // Ambil header
            $headers = array_map('strtolower', $sheetData[0]);

            $dataInsert = [];
            foreach ($sheetData as $index => $row) {
                if ($index == 0) continue; // skip header

                $rowData = array_combine($headers, $row);

                // ambil tanggal dari Excel kalau ada, fallback ke today()
                $tanggalInput = !empty($rowData['tanggal_transaksi'])
                    ? date('Y-m-d', strtotime($rowData['tanggal_transaksi']))
                    : date('Y-m-d');

                // generate kode transaksi (format: dd/mm/YYYY - VOUCHER)
                $kodeTransaksi = date('d/m/Y', strtotime($tanggalInput)) . ' - ' . trim($rowData['voucher'] ?? '');

                $dataBubm = [
                    'kode_transaksi'    => $kodeTransaksi,
                    'voucher'           => trim($rowData['voucher'] ?? ''),
                    'jumlah_rupiah'     => isset($rowData['jumlah_rupiah']) ? (float) preg_replace('/[^0-9.]/', '', $rowData['jumlah_rupiah']) : 0,
                    'keterangan'        => trim($rowData['keterangan'] ?? ''),
                    'nomor_rak'         => trim($rowData['nomor_rak'] ?? ''),
                    'nomor_baris'       => trim($rowData['nomor_baris'] ?? ''),
                    'program'           => 'BUBM',
                    'tanggal_transaksi' => $tanggalInput,
                    'created_at'        => date('Y-m-d H:i:s'),
                    'updated_at'        => date('Y-m-d H:i:s'),
                ];

                if (!empty($dataBubm['voucher'])) {
                    $dataInsert[] = $dataBubm;
                }
            }

            if (!empty($dataInsert)) {
                $this->bubmModel->insertBatch($dataInsert);
            }

            return redirect()->to('/admin/bubm')->with('success', 'Data BUBM berhasil diimport!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal import: ' . $e->getMessage());
        }
    }


    public function update($id)
    {
        // Validasi input
        $validationRules = [
            'voucher' => 'required|min_length[3]|max_length[50]',
            'jumlah_rupiah' => 'required|numeric|greater_than[0]',
            'nomor_rak' => 'required|min_length[1]|max_length[20]',
            'nomor_baris' => 'required|min_length[1]|max_length[20]',
            'dokumen.*' => 'max_size[dokumen,5120]|ext_in[dokumen,png,jpg,jpeg]', // Ubah ke dokumen.* untuk multiple
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Ambil data dari form
        $voucher = $this->request->getPost('voucher');
        $jumlahRupiah = str_replace(',', '', $this->request->getPost('jumlah_rupiah'));
        $nomorRak = $this->request->getPost('nomor_rak');
        $nomorBaris = $this->request->getPost('nomor_baris');
        $keterangan = $this->request->getPost('keterangan');

        // Update kode transaksi berdasarkan voucher
        $kodeTransaksi = date('d/m/Y', strtotime($this->bubmModel->find($id)['tanggal_transaksi'])) . ' - ' . $voucher;

        // Data untuk update
        $bubmData = [
            'kode_transaksi' => $kodeTransaksi,
            'voucher' => $voucher,
            'jumlah_rupiah' => $jumlahRupiah,
            'nomor_rak' => $nomorRak,
            'nomor_baris' => $nomorBaris,
            'keterangan' => $keterangan,
            'updated_at' => Time::now(),
        ];

        // Update data BUBM
        $updated = $this->bubmModel->update($id, $bubmData);

        if ($updated) {
            // Proses upload dokumen jika ada
            $files = $this->request->getFiles();
            if (!empty($files['dokumen'])) {
                foreach ($files['dokumen'] as $file) {
                    if ($file->isValid() && !$file->hasMoved()) {
                        $newName = $file->getRandomName();
                        $file->move(ROOTPATH . 'public/uploads/bubm', $newName);

                        // Simpan data dokumen ke database
                        $dokumenData = [
                            'bubm_id' => $id,
                            'file_name' => $newName,
                            'file_path' => 'uploads/bubm/' . $newName,
                            'file_type' => $file->getClientMimeType(),
                            'file_size' => $file->getSizeByUnit('kb'),
                            'created_at' => Time::now(),
                        ];
                        $this->bubmDokumenModel->insert($dokumenData);
                    }
                }
            }

            return redirect()->to('/admin/bubm')->with('success', 'Data BUBM berhasil diperbarui.');
        }

        return redirect()->back()->with('error', 'Gagal memperbarui data BUBM.');
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