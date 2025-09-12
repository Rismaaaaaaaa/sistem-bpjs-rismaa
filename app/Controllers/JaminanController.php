<?php

namespace App\Controllers;

use App\Models\JaminanModel;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\Reader\Csv;


class JaminanController extends BaseController
{
    protected $jaminanModel;

    public function __construct()
    {
        $this->jaminanModel = new JaminanModel();
    }

   public function index()
{
    // Ambil semua data terbaru (DESC)
    $jaminan = $this->jaminanModel->orderBy('tanggal_transaksi', 'DESC')->findAll();

    // Stats
    $totalData = $this->jaminanModel->countAll();
    $totalNilai = $this->jaminanModel->selectSum('jumlah_bayar')->first()['jumlah_bayar'];
    $totalPerusahaan = $this->jaminanModel->select('nama_perusahaan')->distinct()->countAllResults();

    // Rata-rata per bulan
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

    public function create()
    {
        $data = [
            'title' => 'Tambah Jaminan',
            'active_menu' => 'jaminan',
        ];

        return view('/admin/tambah_jaminan', $data);
    }

    public function store()
    {
        // Validasi input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'nomor_penetapan'   => 'required',
            'tanggal_transaksi' => 'required|valid_date',
            'kode_transaksi'    => 'required',
            'nomor_kpj'         => 'required',
            'nama_perusahaan'   => 'required',
            'pph21'             => 'permit_empty|decimal',
            'jumlah_bayar'      => 'required|decimal',
            'no_rekening'       => 'required',
            'atas_nama'         => 'required',
            'dokumen'           => 'permit_empty|uploaded[dokumen]|is_image[dokumen]|mime_in[dokumen,image/jpg,image/jpeg,image/png]',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        // Handle upload dokumen
        $file = $this->request->getFile('dokumen');
        $fileName = null;

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $fileName = $file->getRandomName();
            $file->move(FCPATH . 'uploads', $fileName);
        }

        // Simpan ke database
        $this->jaminanModel->save([
            'nomor_penetapan'   => $this->request->getPost('nomor_penetapan'),
            'tanggal_transaksi' => $this->request->getPost('tanggal_transaksi'),
            'kode_transaksi'    => $this->request->getPost('kode_transaksi'),
            'nomor_kpj'         => $this->request->getPost('nomor_kpj'),
            'nama_perusahaan'   => $this->request->getPost('nama_perusahaan'),
            'pph21'             => $this->request->getPost('pph21'),
            'jumlah_bayar'      => $this->request->getPost('jumlah_bayar'),
            'no_rekening'       => $this->request->getPost('no_rekening'),
            'atas_nama'         => $this->request->getPost('atas_nama'),
            'dokumen'           => $fileName,
        ]);

        return redirect()->to('/admin/jaminan')->with('success', 'Data Jaminan berhasil disimpan');
    }

    public function update()
    {
        $id = $this->request->getPost('id');

        // upload file (opsional)
        $file = $this->request->getFile('dokumen');
        $fileName = null;
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $fileName = $file->getRandomName();
            $file->move(FCPATH . 'uploads', $fileName);
        }

        $data = [
            'nomor_penetapan'   => $this->request->getPost('nomor_penetapan'),
            'tanggal_transaksi' => $this->request->getPost('tanggal_transaksi'),
            'kode_transaksi'    => $this->request->getPost('kode_transaksi'),
            'nomor_kpj'         => $this->request->getPost('nomor_kpj'),
            'nama_perusahaan'   => $this->request->getPost('nama_perusahaan'),
            'pph21'             => $this->request->getPost('pph21'),
            'jumlah_bayar'      => $this->request->getPost('jumlah_bayar'),
            'no_rekening'       => $this->request->getPost('no_rekening'),
            'atas_nama'         => $this->request->getPost('atas_nama'),
        ];

        if ($fileName) {
            $data['dokumen'] = $fileName;
        }

        $this->jaminanModel->update($id, $data);

        return redirect()->to('/admin/jaminan')->with('success', 'Data Jaminan berhasil diupdate');
    }

    public function delete($id)
    {
        $this->jaminanModel->delete($id);
        return redirect()->to('/admin/jaminan')->with('success', 'Data Jaminan berhasil dihapus');
    }

    
   public function filter()
    {
        $search  = $this->request->getGet('search') ?? '';
        $date    = $this->request->getGet('date') ?? 'all';
        $sortBy  = $this->request->getGet('sortBy') ?? 'newest';

        $builder = $this->jaminanModel;

        // 🔎 Search
        if (!empty($search)) {
            $builder = $builder->like('nomor_penetapan', $search)
                            ->orLike('nomor_kpj', $search);
        }

        // 📅 Filter tanggal
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

        // ↕️ Sorting
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

        // Ambil semua data
        $jaminan = $builder->findAll();

        // Stats
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

        if (!$file->isValid()) {
            return redirect()->back()->with('error', 'File tidak valid');
        }

        $ext = $file->getClientExtension();
        if ($ext === 'csv') {
            $reader = new Csv();
        } else {
            $reader = new Xlsx();
        }

        $spreadsheet = $reader->load($file->getTempName());
        $sheetData   = $spreadsheet->getActiveSheet()->toArray();

        $dataInsert = [];
        foreach ($sheetData as $index => $row) {
            if ($index == 0) continue; // skip header

            $dataInsert[] = [
                'nomor_penetapan'   => $row[0] ?? null,
                'tanggal_transaksi' => !empty($row[1]) ? date('Y-m-d', strtotime($row[1])) : null,
                'kode_transaksi'    => $row[2] ?? null,
                'nomor_kpj'         => $row[3] ?? null,
                'nama_perusahaan'   => $row[4] ?? null,
                'pph21'             => !empty($row[5]) ? (float) $row[5] : 0,
                'jumlah_bayar'      => !empty($row[6]) ? (float) $row[6] : 0,
                'no_rekening'       => $row[7] ?? null,
                'atas_nama'         => $row[8] ?? null,
                'dokumen'           => $row[9] ?? null,
                'created_at'        => date('Y-m-d H:i:s'),
                'updated_at'        => date('Y-m-d H:i:s'),
            ];
        }

        if (!empty($dataInsert)) {
            $this->jaminanModel->insertBatch($dataInsert);
        }

        return redirect()->to('/admin/jaminan')->with('success', 'Data berhasil diimport!');
    }

}
