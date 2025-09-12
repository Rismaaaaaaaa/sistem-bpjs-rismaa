<?php

namespace App\Controllers;

use App\Models\BubmModel;

class BubmController extends BaseController
{
    protected $bubmModel;

    public function __construct()
    {
        $this->bubmModel = new BubmModel();
    }

    public function index()
    {
        // Ambil semua data terbaru
        $bubm = $this->bubmModel->orderBy('id', 'DESC')->findAll();

        // Stats
        $totalData = count($bubm);
        $totalRupiah = array_sum(array_column($bubm, 'jumlah_rupiah'));

        $data = [
            'title'        => 'Data BUBM',
            'active_menu'  => 'bubm',
            'bubm'         => $bubm,
            'totalData'    => $totalData,
            'totalRupiah'  => $totalRupiah,
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
        $file = $this->request->getFile('dokumen');
        $fileName = null;

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $fileName = $file->getRandomName();
            $file->move(FCPATH . 'uploads', $fileName);
        }

        $this->bubmModel->save([
            'kode_transaksi' => $this->request->getPost('kode_transaksi'),
            'voucher'        => $this->request->getPost('voucher'),
            'program'        => $this->request->getPost('program'),
            'jumlah_rupiah'  => $this->request->getPost('jumlah_rupiah'),
            'keterangan'     => $this->request->getPost('keterangan'),
            'dokumen'        => $fileName,
        ]);

        return redirect()->to('/admin/bubm')->with('success', 'Data BUBM berhasil disimpan');
    }

    public function edit($id)
    {
        $bubm = $this->bubmModel->find($id);

        $data = [
            'title'       => 'Edit BUBM',
            'active_menu' => 'bubm',
            'bubm'        => $bubm,
        ];

        return view('admin/edit_bubm', $data);
    }

    public function update($id)
    {
        $file = $this->request->getFile('dokumen');
        $fileName = null;

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $fileName = $file->getRandomName();
            $file->move(FCPATH . 'uploads', $fileName);
        }

        $data = [
            'kode_transaksi' => $this->request->getPost('kode_transaksi'),
            'voucher'        => $this->request->getPost('voucher'),
            'program'        => $this->request->getPost('program'),
            'jumlah_rupiah'  => $this->request->getPost('jumlah_rupiah'),
            'keterangan'     => $this->request->getPost('keterangan'),
        ];

        if ($fileName) {
            $data['dokumen'] = $fileName;
        }

        $this->bubmModel->update($id, $data);

        return redirect()->to('/admin/bubm')->with('success', 'Data BUBM berhasil diupdate');
    }

    public function delete($id)
    {
        $this->bubmModel->delete($id);
        return redirect()->to('/admin/bubm')->with('success', 'Data BUBM berhasil dihapus');
    }
}
