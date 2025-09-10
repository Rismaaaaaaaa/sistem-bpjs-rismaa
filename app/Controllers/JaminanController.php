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
        $data = [
            'title' => 'Data Jaminan',
            'active_menu' => 'jaminan',
            'jaminan' => $this->jaminanModel->findAll(),
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
}
