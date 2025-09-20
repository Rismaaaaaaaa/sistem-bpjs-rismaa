<?php

namespace App\Models;

use CodeIgniter\Model;

class BubmDokumenModel extends Model
{
    protected $table      = 'bubm_dokumen';
    protected $primaryKey = 'id';
    protected $allowedFields = ['bubm_id', 'file_name', 'file_path'];
    protected $useTimestamps = true;

    // Ambil semua dokumen berdasarkan bubm_id
    public function getByBubm($bubmId)
    {
        return $this->where('bubm_id', $bubmId)->findAll();
    }
}
