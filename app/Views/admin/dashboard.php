<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<main class="pt-16 min-h-screen p-6 bg-gray-50">
    <!-- Header -->
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-2xl font-bold text-bpjs-primary flex items-center gap-3">
                <div class="p-2 rounded-lg bg-bpjs-accent/10">
                    <i class="fas fa-tachometer-alt text-bpjs-accent text-xl"></i>
                </div>
                Dashboard BPJS Kesehatan
            </h1>
            <p class="text-gray-600 mt-2 ml-11">Ringkasan data BUBM dan Jaminan BPJS Kesehatan</p>
        </div>
        <div class="flex items-center gap-2 text-sm text-gray-500">
            <i class="fas fa-calendar-alt"></i>
            <span><?= date('d F Y') ?></span>
        </div>
    </div>

    <!-- Statistik Ringkas -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Input BUBM -->
        <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-200 transition hover:shadow-md">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500 mb-2 flex items-center gap-2">
                        <div class="p-2 rounded-lg bg-blue-100">
                            <i class="fas fa-money-check-alt text-blue-600"></i>
                        </div>
                        Total Data BUBM
                    </p>
                    <h3 class="text-2xl font-bold text-gray-800"><?= $totalBubm ?></h3>
                </div>
               
            </div>
        </div>

        <!-- Total Input Jaminan -->
        <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-200 transition hover:shadow-md">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500 mb-2 flex items-center gap-2">
                        <div class="p-2 rounded-lg bg-orange-100">
                            <i class="fas fa-file-medical text-orange-600"></i>
                        </div>
                        Total Data Jaminan
                    </p>
                    <h3 class="text-2xl font-bold text-gray-800"><?= $totalJaminan ?></h3>
                </div>
                
            </div>
        </div>

        <!-- Total Dana Masuk -->
        <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-200 transition hover:shadow-md">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500 mb-2 flex items-center gap-2">
                        <div class="p-2 rounded-lg bg-green-100">
                            <i class="fas fa-money-bill-wave text-green-600"></i>
                        </div>
                        Total Dana Masuk
                    </p>
                    <h3 class="text-2xl font-bold text-gray-800">Rp <?= number_format($totalDana, 0, ',', '.') ?></h3>
                </div>
               
            </div>
        </div>

        <!-- Transaksi Bulan Ini -->
        <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-200 transition hover:shadow-md">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500 mb-2 flex items-center gap-2">
                        <div class="p-2 rounded-lg bg-purple-100">
                            <i class="fas fa-calendar-check text-purple-600"></i>
                        </div>
                        Transaksi Bulan Ini
                    </p>
                    <h3 class="text-2xl font-bold text-gray-800"><?= $bulanIni ?></h3>
                </div>
                <div class="text-blue-500 text-sm font-semibold">
                    <?= date('M Y') ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Grafik dan Charts -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        <!-- Trend Chart -->
        <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm p-6 border border-gray-200">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-semibold text-gray-800 flex items-center gap-2">
                    <i class="fas fa-chart-line text-bpjs-primary"></i>
                    Tren Dana Masuk per Bulan
                </h3>
                <div class="flex gap-2">
                    <span class="flex items-center gap-1 text-sm">
                        <div class="w-3 h-3 bg-orange-500 rounded"></div> BUBM
                    </span>
                    <span class="flex items-center gap-1 text-sm">
                        <div class="w-3 h-3 bg-blue-500 rounded"></div> Jaminan
                    </span>
                </div>
            </div>
            <canvas id="trendChart" height="250"></canvas>
        </div>

        <!-- Program Distribution -->
        <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-200">
            <h3 class="text-lg font-semibold text-gray-800 mb-6 flex items-center gap-2">
                <i class="fas fa-chart-pie text-bpjs-primary"></i>
                Distribusi Program
            </h3>
            <canvas id="programChart" height="250"></canvas>
        </div>
    </div>

    <!-- Bottom Section -->
    <div class="grid grid-cols-1 xl:grid-cols-2 gap-6 mb-8">
        <!-- Top 5 Voucher -->
        <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-200">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-semibold text-gray-800 flex items-center gap-2">
                    <i class="fas fa-trophy text-bpjs-primary"></i>
                    Top 5 Voucher Terbesar
                </h3>
                <span class="text-sm text-gray-500">Bulan <?= date('F') ?></span>
            </div>
            <div class="space-y-4">
                <?php foreach ($topVoucher as $index => $row): ?>
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-xl">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-full bg-gradient-to-r from-bpjs-primary to-blue-600 flex items-center justify-center text-white font-bold text-sm">
                            <?= $index + 1 ?>
                        </div>
                        <div>
                            <p class="font-medium text-gray-800"><?= $row['voucher'] ?></p>
                            <p class="text-sm text-gray-500"><?= $row['program'] ?? 'BUBM' ?></p>
                        </div>
                    </div>
                    <span class="font-semibold text-green-600">Rp <?= number_format($row['total'], 0, ',', '.') ?></span>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Data Terbaru -->
        <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-200">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-semibold text-gray-800 flex items-center gap-2">
                    <i class="fas fa-history text-bpjs-primary"></i>
                    Transaksi Terbaru
                </h3>
                <a href="<?= base_url('admin/bubm') ?>" class="text-sm text-bpjs-primary hover:text-blue-800 transition flex items-center gap-1">
                    Lihat Semua <i class="fas fa-arrow-right"></i>
                </a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b">
                            <th class="text-left p-3 font-medium text-gray-600">Kode</th>
                            <th class="text-left p-3 font-medium text-gray-600">Voucher</th>
                            <th class="text-left p-3 font-medium text-gray-600">Program</th>
                            <th class="text-right p-3 font-medium text-gray-600">Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($recentData as $row): ?>
                        <tr class="border-b hover:bg-gray-50 transition">
                            <td class="p-3 font-medium text-bpjs-primary"><?= $row['kode_transaksi'] ?? '-' ?></td>
                            <td class="p-3"><?= $row['voucher'] ?? '-' ?></td>
                            <td class="p-3">
                                <span class="px-2 py-1 rounded-full text-xs 
                                    <?= ($row['program'] ?? 'Jaminan') === 'Jaminan' ? 'bg-blue-100 text-blue-800' : 'bg-orange-100 text-orange-800' ?>">
                                    <?= $row['program'] ?? 'Jaminan' ?>
                                </span>
                            </td>
                            <td class="p-3 text-right font-semibold text-green-600">
                                Rp <?= number_format($row['jumlah_rupiah'] ?? $row['jumlah_bayar'] ?? 0, 0, ',', '.') ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-200">
        <h3 class="text-lg font-semibold text-gray-800 mb-6 flex items-center gap-2">
            <i class="fas fa-bolt text-bpjs-primary"></i>
            Akses Cepat
        </h3>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <a href="<?= base_url('admin/tambah_bubm') ?>" class="flex flex-col items-center p-4 bg-blue-50 rounded-xl hover:bg-blue-100 transition">
                <div class="p-3 rounded-lg bg-blue-100 mb-2">
                    <i class="fas fa-plus text-blue-600 text-xl"></i>
                </div>
                <span class="text-sm font-medium text-gray-800">Tambah BUBM</span>
            </a>
            <a href="<?= base_url('admin/jaminan/create') ?>" class="flex flex-col items-center p-4 bg-orange-50 rounded-xl hover:bg-orange-100 transition">
                <div class="p-3 rounded-lg bg-orange-100 mb-2">
                    <i class="fas fa-file-medical text-orange-600 text-xl"></i>
                </div>
                <span class="text-sm font-medium text-gray-800">Tambah Jaminan</span>
            </a>
            <a href="<?= base_url('admin/bubm') ?>" class="flex flex-col items-center p-4 bg-green-50 rounded-xl hover:bg-green-100 transition">
                <div class="p-3 rounded-lg bg-green-100 mb-2">
                    <i class="fas fa-list text-green-600 text-xl"></i>
                </div>
                <span class="text-sm font-medium text-gray-800">Data BUBM</span>
            </a>
            <a href="<?= base_url('admin/jaminan') ?>" class="flex flex-col items-center p-4 bg-purple-50 rounded-xl hover:bg-purple-100 transition">
                <div class="p-3 rounded-lg bg-purple-100 mb-2">
                    <i class="fas fa-database text-purple-600 text-xl"></i>
                </div>
                <span class="text-sm font-medium text-gray-800">Data Jaminan</span>
            </a>
        </div>
    </div>
</main>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const trendBubm = <?= json_encode($trendBubm) ?>;
    const trendJaminan = <?= json_encode($trendJaminan) ?>;

    // Daftar bulan fix Januari–Desember
    const monthNames = [
        "Jan", "Feb", "Mar", "Apr", "Mei", "Jun",
        "Jul", "Agu", "Sep", "Okt", "Nov", "Des"
    ];

    // Dataset BUBM & Jaminan
    const bubmData = monthNames.map((_, i) => {
        const found = trendBubm.find(item => item.bulan == (i + 1));
        return found ? parseFloat(found.total) : 0;
    });

    const jaminanData = monthNames.map((_, i) => {
        const found = trendJaminan.find(item => item.bulan == (i + 1));
        return found ? parseFloat(found.total) : 0;
    });

    // Line Chart
    new Chart(document.getElementById('trendChart'), {
        type: 'line',
        data: {
            labels: monthNames,
            datasets: [
                {
                    label: 'BUBM',
                    data: bubmData,
                    borderColor: '#e4943c',
                    backgroundColor: 'rgba(228, 148, 60, 0.1)',
                    fill: true,
                    tension: 0.4,
                    borderWidth: 2
                },
                {
                    label: 'Jaminan',
                    data: jaminanData,
                    borderColor: '#1c5ca4',
                    backgroundColor: 'rgba(28, 92, 164, 0.1)',
                    fill: true,
                    tension: 0.4,
                    borderWidth: 2
                }
            ]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return context.dataset.label + ': Rp ' + 
                                new Intl.NumberFormat('id-ID').format(context.raw);
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return 'Rp ' + new Intl.NumberFormat('id-ID').format(value);
                        }
                    }
                }
            }
        }
    });

    // Pie Chart distribusi program
    const distribusi = <?= json_encode($distribusiProgram) ?>;
    new Chart(document.getElementById('programChart'), {
        type: 'doughnut',
        data: {
            labels: distribusi.map(d => d.program),
            datasets: [{
                data: distribusi.map(d => d.total),
                backgroundColor: [
                    '#e4943c', '#1c5ca4', '#10b981', '#f59e0b', '#ef4444',
                    '#8b5cf6', '#06b6d4', '#84cc16', '#f97316', '#64748b'
                ],
                borderWidth: 2,
                borderColor: '#ffffff'
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'right',
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return context.label + ': Rp ' + 
                                new Intl.NumberFormat('id-ID').format(context.raw);
                        }
                    }
                }
            }
        }
    });
</script>

<style>
    .hover\:shadow-md {
        transition: all 0.3s ease;
    }
    
    .hover\:shadow-md:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }
</style>

<?= $this->endSection() ?>