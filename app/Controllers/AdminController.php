<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BubmModel;
use App\Models\JaminanModel;
use CodeIgniter\I18n\Time;

class AdminController extends BaseController
{
    public function dashboard()
    {
        $bubmModel    = new BubmModel();
        $jaminanModel = new JaminanModel();

        // === 1. Statistik Ringkas ===
        $totalBubm    = $bubmModel->countAllResults();
        $totalJaminan = $jaminanModel->countAllResults();

        $totalDanaBubm = $bubmModel
            ->selectSum('jumlah_rupiah')
            ->first()['jumlah_rupiah'] ?? 0;

        $totalDanaJaminan = $jaminanModel
            ->selectSum('jumlah_bayar')
            ->first()['jumlah_bayar'] ?? 0;

        $totalDana = $totalDanaBubm + $totalDanaJaminan;

        $totalVoucher = $bubmModel
            ->select('COUNT(DISTINCT voucher) as total')
            ->first()['total'] ?? 0;

        $bulanIniBubm = $bubmModel
            ->where('MONTH(tanggal_transaksi)', Time::now()->getMonth())
            ->where('YEAR(tanggal_transaksi)', Time::now()->getYear())
            ->countAllResults();

        $bulanIniJaminan = $jaminanModel
            ->where('MONTH(tanggal_transaksi)', Time::now()->getMonth())
            ->where('YEAR(tanggal_transaksi)', Time::now()->getYear())
            ->countAllResults();

        $bulanIni = $bulanIniBubm + $bulanIniJaminan;

        // === 2. Grafik & Visualisasi ===
    $yearNow = date('Y'); // otomatis ambil tahun sekarang

$trendBubm = $bubmModel
    ->select("MONTH(tanggal_transaksi) as bulan, SUM(jumlah_rupiah) as total")
    ->where("YEAR(tanggal_transaksi)", $yearNow)
    ->groupBy('bulan')
    ->orderBy('bulan', 'ASC')
    ->findAll();

$trendJaminan = $jaminanModel
    ->select("MONTH(tanggal_transaksi) as bulan, SUM(jumlah_bayar) as total")
    ->where("YEAR(tanggal_transaksi)", $yearNow)
    ->groupBy('bulan')
    ->orderBy('bulan', 'ASC')
    ->findAll();

        // Distribusi Program (dari bubm)
        $distribusiProgram = $bubmModel
            ->select("program, COUNT(*) as total")
            ->groupBy('program')
            ->findAll();

        // Top 5 Voucher Terbesar
        $topVoucher = $bubmModel
            ->select("voucher, SUM(jumlah_rupiah) as total")
            ->groupBy('voucher')
            ->orderBy('total', 'DESC')
            ->limit(5)
            ->findAll();

        // === 3. Data Terbaru ===
        $recentBubm = $bubmModel->orderBy('tanggal_transaksi', 'DESC')->limit(5)->find();
        $recentJaminan = $jaminanModel->orderBy('tanggal_transaksi', 'DESC')->limit(5)->find();

        $recentData = array_merge($recentBubm, $recentJaminan);

        $data = [
            // Statistik
            'totalBubm'     => $totalBubm,
            'totalJaminan'  => $totalJaminan,
            'totalDana'     => $totalDana,
            'totalVoucher'  => $totalVoucher,
            'bulanIni'      => $bulanIni,

            // Grafik
            'trendBubm'     => $trendBubm,
            'trendJaminan'  => $trendJaminan,
            'distribusiProgram' => $distribusiProgram,
            'topVoucher'    => $topVoucher,

            // Tabel
            'recentData'    => $recentData,
        ];

        return view('admin/dashboard', $data);
    }
}
