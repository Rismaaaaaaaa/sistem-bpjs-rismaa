<?php

namespace App\Controllers;

class JaminanController extends BaseController
{
    public function index()
    {
         return view('admin/jaminan', [
        'active_menu' => 'jaminan'
    ]);
    }
}
