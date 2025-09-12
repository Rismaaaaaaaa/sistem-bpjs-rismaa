<?php

namespace App\Controllers;

use App\Models\JaminanModel;

class JaminanController extends BaseController
{
    protected $jaminanModel;

    public function __construct()
    {
        $this->jaminanModel = new JaminanModel();
    }

  public function index()
    {
        // Ambil semua data
        $jaminan = $this->jaminanModel->findAll();

        // Total semua data
        $totalData = count($jaminan);

        // Total nilai (jumlah_bayar)
        $totalNilai = array_sum(array_column($jaminan, 'jumlah_bayar'));

        // Total perusahaan (distinct nama_perusahaan)
        $totalPerusahaan = count(array_unique(array_column($jaminan, 'nama_perusahaan')));

        // Rata-rata per bulan (jumlah_bayar / jumlah bulan)
        $builder = $this->jaminanModel
            ->select("DATE_FORMAT(tanggal_transaksi, '%Y-%m') as bulan, SUM(jumlah_bayar) as total")
            ->groupBy("bulan")
            ->get()
            ->getResultArray();

        $totalBulan = count($builder);
        $rataRata = $totalBulan > 0 ? array_sum(array_column($builder, 'total')) / $totalBulan : 0;

        $data = [
            'title'           => 'Data Jaminan',
            'active_menu'     => 'jaminan',
            'jaminan'         => $jaminan,
            'totalData'       => $totalData,
            'totalNilai'      => $totalNilai,
            'totalPerusahaan' => $totalPerusahaan,
            'rataRata'        => $rataRata,
            // Filter default supaya view bisa pakai variabel ini
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

        return view('jaminan/create', $data);
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

    $builder = $this->jaminanModel->builder();

    // 🔎 Search
    if (!empty($search)) {
        $builder->groupStart()
            ->like('nomor_penetapan', $search)
            ->orLike('nomor_kpj', $search)
            ->groupEnd();
    }

    // 📅 Filter tanggal
    if ($date !== 'all') {
        $today = date('Y-m-d');
        switch ($date) {
            case 'today':
                $builder->where('DATE(tanggal_transaksi)', $today);
                break;
            case 'week':
                $builder->where('YEARWEEK(tanggal_transaksi)', date('oW'));
                break;
            case 'month':
                $builder->where('MONTH(tanggal_transaksi)', date('m'))
                        ->where('YEAR(tanggal_transaksi)', date('Y'));
                break;
            case 'year':
                $builder->where('YEAR(tanggal_transaksi)', date('Y'));
                break;
        }
    }

    // ↕️ Sorting
    switch ($sortBy) {
        case 'oldest':
            $builder->orderBy('tanggal_transaksi', 'ASC');
            break;
        case 'amount_desc':
            $builder->orderBy('jumlah_bayar', 'DESC');
            break;
        case 'amount_asc':
            $builder->orderBy('jumlah_bayar', 'ASC');
            break;
        default:
            $builder->orderBy('tanggal_transaksi', 'DESC');
    }

    $jaminan = $builder->get()->getResultArray();

    // 🔢 Stats
    $totalData = $this->jaminanModel->countAllResults();
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
        // 🔹 Kirim juga variabel filter supaya view aman
        'search'          => $search,
        'date'            => $date,
        'sortBy'          => $sortBy,
    ];

    return view('admin/jaminan', $data);
}



}
