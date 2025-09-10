<?php

namespace App\Controllers;

class Jaminan extends BaseController
{
    public function index()
    {
         return view('admin/jaminan', [
        'active_menu' => 'jaminan'
    ]);
    }
}
