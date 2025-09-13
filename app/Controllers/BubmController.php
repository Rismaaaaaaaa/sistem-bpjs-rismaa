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

        // ✅ Hitung total rupiah
        $totalRupiah = 0;
        if (!empty($bubm)) {
            $totalRupiah = array_sum(array_map(fn($r) => (float)($r['jumlah_rupiah'] ?? 0), $bubm));
        }

        $data = [
            'title'       => 'Data BUBM',
            'active_menu' => 'bubm',
            'bubm'        => $bubm,
            'totalData'   => count($bubm),
            'totalRupiah' => $totalRupiah,   // <-- kirim ke view
            'search'      => $search,
            'date'        => $date,
            'sortBy'      => $sortBy,
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


        public function update($id)
    {
        $data = $this->bubmModel->find($id);

        if (!$data) {
            return redirect()->to('/admin/bubm')->with('error', 'Data tidak ditemukan');
        }

        $file = $this->request->getFile('dokumen');
        $fileName = $data['dokumen']; // default pakai yang lama

        if ($file && $file->isValid() && !$file->hasMoved()) {
            // hapus file lama
            if (!empty($data['dokumen']) && file_exists(WRITEPATH . 'uploads/bubm/' . $data['dokumen'])) {
                unlink(WRITEPATH . 'uploads/bubm/' . $data['dokumen']);
            }
            $fileName = $file->getRandomName();
            $file->move(WRITEPATH . 'uploads/bubm', $fileName);
        }

        $this->bubmModel->update($id, [
            'voucher'       => $this->request->getPost('voucher'),
            'jumlah_rupiah' => $this->request->getPost('jumlah_rupiah'),
            'keterangan'    => $this->request->getPost('keterangan'),
            'dokumen'       => $fileName,
        ]);

        return redirect()->to('/admin/bubm')->with('success', 'Data BUBM berhasil diperbarui');
    }

        public function delete($id)
    {
        // Cari data berdasarkan ID
        $data = $this->bubmModel->find($id);

        if (!$data) {
            return redirect()->to('/admin/bubm')->with('error', 'Data BUBM tidak ditemukan');
        }

        // Hapus file dokumen kalau ada
        if (!empty($data['dokumen'])) {
            $filePath = WRITEPATH . 'uploads/bubm/' . $data['dokumen'];
            if (is_file($filePath)) {
                unlink($filePath);
            }
        }

        // Hapus data dari database
        $this->bubmModel->delete($id);

        return redirect()->to('/admin/bubm')->with('success', 'Data BUBM berhasil dihapus');
    }

  public function store()
{
    $voucher = $this->request->getPost('voucher');

    $today          = date('d/m/Y');
    $kodeTransaksi  = $today . ' - ' . $voucher;

    $file     = $this->request->getFile('dokumen');
    $fileName = null;

    if ($file && $file->isValid() && !$file->hasMoved()) {
        $fileName = $file->getRandomName();
        $file->move(WRITEPATH . 'uploads/bubm', $fileName);
    }

    // Ambil jumlah_rupiah dan bersihkan dari titik/format ribuan
    $jumlahRupiah = $this->request->getPost('jumlah_rupiah');
    $jumlahRupiah = preg_replace('/[^0-9]/', '', $jumlahRupiah); // buang semua non-digit

    $this->bubmModel->save([
        'kode_transaksi' => $kodeTransaksi,
        'voucher'        => $voucher,
        'program'        => $this->request->getPost('program') ?? 'BUBM',
        'jumlah_rupiah'  => $jumlahRupiah,
        'keterangan'     => $this->request->getPost('keterangan'),
        'dokumen'        => $fileName,
    ]);

    return redirect()->to('/admin/bubm')->with('success', 'Data BUBM berhasil disimpan');
}


    public function filter()
    {
        $search = $this->request->getGet('search');
        $date   = $this->request->getGet('date');
        $sortBy = $this->request->getGet('sortBy');

        $builder = $this->bubmModel;

        // 🔎 Search
        if (!empty($search)) {
            $builder = $builder->groupStart()
                ->like('kode_transaksi', $search)
                ->orLike('voucher', $search)
                ->orLike('program', $search)
                ->groupEnd();
        }

        // 📅 Filter tanggal
        if ($date && $date !== 'all') {
            $today = date('Y-m-d');
            if ($date === 'today') {
                $builder = $builder->where('DATE(tanggal_transaksi)', $today);
            } elseif ($date === 'week') {
                $builder = $builder->where('YEARWEEK(tanggal_transaksi, 1)', date('oW'));
            } elseif ($date === 'month') {
                $builder = $builder->where('MONTH(tanggal_transaksi)', date('m'))
                                ->where('YEAR(tanggal_transaksi)', date('Y'));
            } elseif ($date === 'year') {
                $builder = $builder->where('YEAR(tanggal_transaksi)', date('Y'));
            }
        }

        // ↕️ Sort
        if ($sortBy === 'oldest') {
            $builder = $builder->orderBy('tanggal_transaksi', 'ASC');
        } elseif ($sortBy === 'amount_desc') {
            $builder = $builder->orderBy('jumlah_rupiah', 'DESC');
        } elseif ($sortBy === 'amount_asc') {
            $builder = $builder->orderBy('jumlah_rupiah', 'ASC');
        } else {
            $builder = $builder->orderBy('tanggal_transaksi', 'DESC'); // default newest
        }

        $bubm = $builder->findAll();

        // ✅ Hitung total rupiah biar sama kayak index()
        $totalRupiah = 0;
        if (!empty($bubm)) {
            $totalRupiah = array_sum(array_map(fn($r) => (float)($r['jumlah_rupiah'] ?? 0), $bubm));
        }

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
