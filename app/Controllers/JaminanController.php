<?php

namespace App\Controllers;

use App\Models\JaminanModel;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Spreadsheet;



class JaminanController extends BaseController
{
    protected $jaminanModel;

    public function __construct()
    {
        $this->jaminanModel = new JaminanModel();
    }
    public function create()
    {
        $data = [
            'title' => 'Tambah Jaminan',
            'active_menu' => 'jaminan',
        ];

        return view('/admin/tambah_jaminan', $data);
    }

    public function index()
    {
        $jaminan = $this->jaminanModel->orderBy('tanggal_transaksi', 'DESC')->findAll();

        $dokumenModel = new \App\Models\JaminanDokumenModel();

        foreach ($jaminan as &$row) {
            $row['dokumen_list'] = $dokumenModel
                ->where('jaminan_id', $row['id'])
                ->findAll();
        }

        $totalData = $this->jaminanModel->countAll();
        $totalNilai = $this->jaminanModel->selectSum('jumlah_bayar')->first()['jumlah_bayar'];
        $totalPerusahaan = $this->jaminanModel->select('nama_perusahaan')->distinct()->countAllResults();

        $bulanData = $this->jaminanModel
            ->select("DATE_FORMAT(tanggal_transaksi, '%Y-%m') as bulan, SUM(jumlah_bayar) as total")
            ->groupBy("bulan")
            ->get()
            ->getResultArray();

        $totalBulan = count($bulanData);
        $rataRata = $totalBulan > 0 ? array_sum(array_column($bulanData, 'total')) / $totalBulan : 0;

        $data = [
            'title'           => 'Data Jaminan',
            'active_menu'     => 'jaminan',
            'jaminan'         => $jaminan,
            'totalData'       => $totalData,
            'totalNilai'      => $totalNilai,
            'totalPerusahaan' => $totalPerusahaan,
            'rataRata'        => $rataRata,
            'search'          => '',
            'date'            => 'all',
            'sortBy'          => 'newest'
        ];

        return view('admin/jaminan', $data);
    }


    public function store()
    {
        $validation = \Config\Services::validation();
        $validation->setRules([
            'nomor_penetapan'   => 'required',
            'tanggal_transaksi' => 'required|valid_date',
            'kode_transaksi'    => 'required',
            'nomor_kpj'         => 'required',
            'nama_tenaga_kerja' => 'required',
            'nama_perusahaan'   => 'required',
            'pph21'             => 'permit_empty|decimal',
            'jumlah_bayar'      => 'required|decimal',
            'no_rekening'       => 'required',
            'atas_nama'         => 'required',
            'nomor_rak'         => 'required',
            'nomor_baris'       => 'required',
            'dokumen.*'         => 'if_exist|is_image[dokumen.*]|mime_in[dokumen.*,image/jpg,image/jpeg,image/png]',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        // Simpan data jaminan
        $jaminanId = $this->jaminanModel->insert([
            'nomor_penetapan'   => $this->request->getPost('nomor_penetapan'),
            'tanggal_transaksi' => $this->request->getPost('tanggal_transaksi'),
            'kode_transaksi'    => $this->request->getPost('kode_transaksi'),
            'nomor_kpj'         => $this->request->getPost('nomor_kpj'),
            'nama_tenaga_kerja' => $this->request->getPost('nama_tenaga_kerja'),
            'nama_perusahaan'   => $this->request->getPost('nama_perusahaan'),
            'pph21'             => $this->request->getPost('pph21'),
            'jumlah_bayar'      => $this->request->getPost('jumlah_bayar'),
            'no_rekening'       => $this->request->getPost('no_rekening'),
            'atas_nama'         => $this->request->getPost('atas_nama'),
            'nomor_rak'         => $this->request->getPost('nomor_rak'),
            'nomor_baris'       => $this->request->getPost('nomor_baris'),
        ]);

        // Upload multiple dokumen
        $files = $this->request->getFiles();
        if ($files && isset($files['dokumen'])) {
            $uploadPath = FCPATH . 'uploads/jaminan/';
            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }

            $dokumenModel = new \App\Models\JaminanDokumenModel();

            foreach ($files['dokumen'] as $file) {
                if ($file->isValid() && !$file->hasMoved()) {
                    $fileName = $file->getRandomName();
                    $file->move($uploadPath, $fileName);

                    // simpan ke tabel jaminan_dokumen
                    $dokumenModel->insert([
                        'jaminan_id' => $jaminanId,
                        'file_path'  => $fileName
                    ]);
                }
            }
        }

        return redirect()->to('/admin/jaminan')->with('success', 'Data Jaminan berhasil disimpan');
    }






    public function exportExcel()
    {
        $search  = $this->request->getGet('search');
        $date    = $this->request->getGet('date');
        $sortBy  = $this->request->getGet('sortBy');

        // Ambil data sesuai filter
        $jaminan = $this->jaminanModel->getFilteredData($search, $date, $sortBy);
        $dokumenModel = new \App\Models\JaminanDokumenModel();

        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Header
        $headers = [
            'A1' => 'Nomor Penetapan',
            'B1' => 'Tanggal Transaksi',
            'C1' => 'Kode Transaksi',
            'D1' => 'Nomor KPJ',
            'E1' => 'Nama Tenaga Kerja',
            'F1' => 'Nama Perusahaan',
            'G1' => 'PPh21',
            'H1' => 'Jumlah Bayar',
            'I1' => 'No Rekening',
            'J1' => 'Atas Nama',
            'K1' => 'Nomor Rak',
            'L1' => 'Nomor Baris',
            'M1' => 'Dokumen',
        ];
        foreach ($headers as $col => $text) {
            $sheet->setCellValue($col, $text);
        }

        // Data
        $row = 2;
        foreach ($jaminan as $item) {
            // Ambil dokumen terkait untuk jaminan ini
            $dokumens = $dokumenModel->where('jaminan_id', $item['id'])->findAll();
            $dokumenList = implode(', ', array_map(fn($doc) => $doc['file_path'], $dokumens));

            $sheet->setCellValue('A' . $row, $item['nomor_penetapan']);
            $sheet->setCellValue('B' . $row, $item['tanggal_transaksi']);
            $sheet->setCellValue('C' . $row, $item['kode_transaksi']);
            $sheet->setCellValue('D' . $row, $item['nomor_kpj']);
            $sheet->setCellValue('E' . $row, $item['nama_tenaga_kerja']);
            $sheet->setCellValue('F' . $row, $item['nama_perusahaan']);
            $sheet->setCellValue('G' . $row, $item['pph21']);
            $sheet->setCellValue('H' . $row, $item['jumlah_bayar']);
            $sheet->setCellValue('I' . $row, $item['no_rekening']);
            $sheet->setCellValue('J' . $row, $item['atas_nama']);
            $sheet->setCellValue('K' . $row, $item['nomor_rak']);
            $sheet->setCellValue('L' . $row, $item['nomor_baris']);
            $sheet->setCellValue('M' . $row, $dokumenList ?: '-');
            $row++;
        }

        // Download response
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        $filename = 'data_jaminan_' . date('Ymd_His') . '.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment;filename=\"$filename\"");
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        exit;
    }



    public function update()
    {
        $id = $this->request->getPost('id');

        // update data utama jaminan
        $data = [
            'nomor_penetapan'   => $this->request->getPost('nomor_penetapan'),
            'tanggal_transaksi' => $this->request->getPost('tanggal_transaksi'),
            'kode_transaksi'    => $this->request->getPost('kode_transaksi'),
            'nomor_kpj'         => $this->request->getPost('nomor_kpj'),
            'nama_perusahaan'   => $this->request->getPost('nama_perusahaan'),
            'nama_tenaga_kerja' => $this->request->getPost('nama_tenaga_kerja'),
            'pph21'             => $this->request->getPost('pph21'),
            'jumlah_bayar'      => $this->request->getPost('jumlah_bayar'),
            'no_rekening'       => $this->request->getPost('no_rekening'),
            'atas_nama'         => $this->request->getPost('atas_nama'),
            'nomor_rak'         => $this->request->getPost('nomor_rak'),
            'nomor_baris'       => $this->request->getPost('nomor_baris'),
        ];

        $this->jaminanModel->update($id, $data);

        // cek apakah ada dokumen baru yang diupload
        $files = $this->request->getFiles();
        if ($files && isset($files['dokumen'])) {
            $uploadPath = FCPATH . 'uploads/jaminan/';
            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }

            $dokumenModel = new \App\Models\JaminanDokumenModel();

            // hapus semua file lama (fisik + DB)
            $oldFiles = $dokumenModel->where('jaminan_id', $id)->findAll();
            foreach ($oldFiles as $old) {
                $oldPath = $uploadPath . $old['file_path'];
                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }
            $dokumenModel->where('jaminan_id', $id)->delete();

            // simpan dokumen baru
            foreach ($files['dokumen'] as $file) {
                if ($file->isValid() && !$file->hasMoved()) {
                    $fileName = $file->getRandomName();
                    $file->move($uploadPath, $fileName);

                    $dokumenModel->insert([
                        'jaminan_id' => $id,
                        'file_path'  => $fileName,
                    ]);
                }
            }
        }

        return redirect()->to('/admin/jaminan')->with('success', 'Data Jaminan berhasil diupdate');
    }





   public function delete($id)
{
    // Cari data jaminan induk
    $jaminan = $this->jaminanModel->find($id);

    if ($jaminan) {
        // Ambil semua dokumen terkait dari tabel jaminan_dokumen
        $dokumenModel = new \App\Models\JaminanDokumenModel();
        $dokumens = $dokumenModel->where('jaminan_id', $id)->findAll();

        // Hapus file fisik
        foreach ($dokumens as $doc) {
            $path = FCPATH . 'uploads/jaminan/' . $doc['file_path'];
            if (file_exists($path)) {
                unlink($path);
            }
        }

        // Hapus record dokumen dari DB
        $dokumenModel->where('jaminan_id', $id)->delete();

        // Hapus data induk jaminan
        $this->jaminanModel->delete($id);

        return redirect()->to('/admin/jaminan')
            ->with('success', 'Data Jaminan dan semua dokumen berhasil dihapus');
    }

    return redirect()->to('/admin/jaminan')
        ->with('error', 'Data Jaminan tidak ditemukan');
}


    public function viewFile($filename)
    {
        $path = FCPATH . 'uploads/jaminan/' . $filename;
        if (!file_exists($path)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("File tidak ditemukan");
        }
        return $this->response->download($path, null)->setFileName($filename);
    }


    public function filter()
    {
        $search  = $this->request->getGet('search') ?? '';
        $date    = $this->request->getGet('date') ?? 'all';
        $sortBy  = $this->request->getGet('sortBy') ?? 'newest';

        $builder = $this->jaminanModel;

        if (!empty($search)) {
            $builder = $builder
                ->groupStart()
                    ->like('nomor_penetapan', $search)
                    ->orLike('nomor_kpj', $search)
                    ->orLike('nomor_rak', $search)
                    ->orLike('nomor_baris', $search)
                ->groupEnd();
        }



        if ($date !== 'all') {
            $today = date('Y-m-d');
            switch ($date) {
                case 'today':
                    $builder = $builder->where('DATE(tanggal_transaksi)', $today);
                    break;
                case 'week':
                    $builder = $builder->where('YEARWEEK(tanggal_transaksi)', date('oW'));
                    break;
                case 'month':
                    $builder = $builder->where('MONTH(tanggal_transaksi)', date('m'))
                        ->where('YEAR(tanggal_transaksi)', date('Y'));
                    break;
                case 'year':
                    $builder = $builder->where('YEAR(tanggal_transaksi)', date('Y'));
                    break;
            }
        }

        switch ($sortBy) {
            case 'oldest':
                $builder = $builder->orderBy('tanggal_transaksi', 'ASC');
                break;
            case 'amount_desc':
                $builder = $builder->orderBy('jumlah_bayar', 'DESC');
                break;
            case 'amount_asc':
                $builder = $builder->orderBy('jumlah_bayar', 'ASC');
                break;
            default:
                $builder = $builder->orderBy('tanggal_transaksi', 'DESC');
        }

        $jaminan = $builder->findAll();

        $totalData = $this->jaminanModel->countAll();
        $totalNilai = $this->jaminanModel->selectSum('jumlah_bayar')->first()['jumlah_bayar'];
        $totalPerusahaan = $this->jaminanModel->select('nama_perusahaan')->distinct()->countAllResults();

        $bulanData = $this->jaminanModel
            ->select("DATE_FORMAT(tanggal_transaksi, '%Y-%m') as bulan, SUM(jumlah_bayar) as total")
            ->groupBy("bulan")
            ->get()
            ->getResultArray();

        $totalBulan = count($bulanData);
        $rataRata = $totalBulan > 0 ? array_sum(array_column($bulanData, 'total')) / $totalBulan : 0;

        $data = [
            'title'           => 'Data Jaminan',
            'active_menu'     => 'jaminan',
            'jaminan'         => $jaminan,
            'totalData'       => $totalData,
            'totalNilai'      => $totalNilai,
            'totalPerusahaan' => $totalPerusahaan,
            'rataRata'        => $rataRata,
            'search'          => $search,
            'date'            => $date,
            'sortBy'          => $sortBy,
        ];

        return view('admin/jaminan', $data);
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

            // Ambil header dari row pertama
            $headers = array_map('strtolower', $sheetData[0]);

            $dataInsert = [];
            foreach ($sheetData as $index => $row) {
                if ($index == 0) continue; // skip header

                $rowData = array_combine($headers, $row);

                // Handle tanggal
                $tanggalTransaksi = null;
                if (!empty($rowData['tanggal_transaksi'])) {
                    if (is_numeric($rowData['tanggal_transaksi'])) {
                        $tanggalTransaksi = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject(
                            $rowData['tanggal_transaksi']
                        )->format('Y-m-d');
                    } else {
                        $tanggalTransaksi = date('Y-m-d', strtotime($rowData['tanggal_transaksi']));
                    }
                }

                $dataInsert[] = [
                    'nomor_penetapan'   => trim($rowData['nomor_penetapan'] ?? ''),
                    'tanggal_transaksi' => $tanggalTransaksi,
                    'kode_transaksi'    => trim($rowData['kode_transaksi'] ?? ''),
                    'nomor_kpj'         => trim($rowData['nomor_kpj'] ?? ''),
                    'nama_tenaga_kerja' => trim($rowData['nama_tenaga_kerja'] ?? ''),
                    'nama_perusahaan'   => trim($rowData['nama_perusahaan'] ?? ''),
                    'pph21'             => isset($rowData['pph21']) ? (float) preg_replace('/[^0-9.]/', '', $rowData['pph21']) : 0,
                    'jumlah_bayar'      => isset($rowData['jumlah_bayar']) ? (float) preg_replace('/[^0-9.]/', '', $rowData['jumlah_bayar']) : 0,
                    'no_rekening'       => trim($rowData['no_rekening'] ?? ''),
                    'atas_nama'         => trim($rowData['atas_nama'] ?? ''),
                    'nomor_rak'         => trim($rowData['nomor_rak'] ?? ''), // ✅ tambahin nomor rak
                    'dokumen'           => trim($rowData['dokumen'] ?? ''),
                    'created_at'        => date('Y-m-d H:i:s'),
                    'updated_at'        => date('Y-m-d H:i:s'),
                ];
            }

            if (!empty($dataInsert)) {
                $this->jaminanModel->insertBatch($dataInsert);
            }

            return redirect()->to('/admin/jaminan')->with('success', 'Data berhasil diimport!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal import: ' . $e->getMessage());
        }
    }





}
