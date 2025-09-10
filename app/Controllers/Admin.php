<?php

namespace App\Controllers;

class Admin extends BaseController
{
    public function index()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        if (session()->get('role') !== 'admin') {
            return redirect()->to('/login')->with('error', 'Tidak punya akses');
        }

        return "Halo Admin 👋, ini dashboard Admin!";
    }
}
