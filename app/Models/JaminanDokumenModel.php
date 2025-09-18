<?php

namespace App\Models;

use CodeIgniter\Model;

class JaminanDokumenModel extends Model
{
    protected $table = 'jaminan_dokumen';
    protected $primaryKey = 'id';
    protected $allowedFields = ['jaminan_id', 'file_path'];
    protected $useTimestamps = true;

    // Ambil semua dokumen berdasarkan jaminan_id
    public function getByJaminan($jaminanId)
    {
        return $this->where('jaminan_id', $jaminanId)->findAll();
    }
}
