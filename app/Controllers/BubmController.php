<?php

namespace App\Controllers;
use App\Models\JaminanModel;

class BubmController extends BaseController
{
    public function index()
    {
        return view('admin/bubm');
    }

     protected $jaminanModel;

    public function __construct()
    {
        $this->jaminanModel = new JaminanModel();
    }

    public function coba()
    {
        $data = [
            'title' => 'Data Jaminan',
            'active_menu' => 'jaminan',
            'jaminan' => $this->jaminanModel->findAll(),
        ];

        return view('admin/peserta', $data);
    }
}
