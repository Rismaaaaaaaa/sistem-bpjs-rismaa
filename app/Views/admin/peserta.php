<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="p-6">
    <!-- Header -->
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-bpjs-primary flex items-center gap-3">
                <div class="p-2 rounded-lg bg-bpjs-accent/10">
                    <i class="fas fa-file-medical text-bpjs-accent text-xl"></i>
                </div>
                Data Jaminan BPJS
            </h1>
            <p class="text-gray-600 mt-2 ml-11">Kelola data jaminan peserta BPJS Kesehatan</p>
        </div>
        <a href="#" class="flex items-center gap-2 px-4 py-2.5 rounded-xl bg-gradient-to-r from-bpjs-accent to-orange-500 text-white font-semibold hover:opacity-90 shadow-lg transition">
            <i class="fas fa-plus"></i>
            Tambah Data
        </a>
    </div>

    <!-- Search and Filter Section -->
    <div class="bg-white rounded-2xl shadow-sm p-5 mb-6 border border-gray-200">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <!-- Search Input -->
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-search text-bpjs-primary mr-1"></i>
                    Cari Data
                </label>
                <div class="relative">
                    <i class="fas fa-search absolute left-3 top-3.5 text-gray-400"></i>
                    <input type="text" id="searchInput" placeholder="Cari berdasarkan no. penetapan, perusahaan, atau no. KPJ..." 
                        class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-bpjs-accent/50 text-gray-700 transition">
                </div>
            </div>

            <!-- Filter by Date -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-filter text-bpjs-primary mr-1"></i>
                    Filter Tanggal
                </label>
                <div class="relative">
                    <i class="fas fa-calendar-alt absolute left-3 top-3.5 text-gray-400"></i>
                    <select id="dateFilter" class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-bpjs-accent/50 text-gray-700 transition appearance-none">
                        <option value="all">Semua Tanggal</option>
                        <option value="today">Hari Ini</option>
                        <option value="week">Minggu Ini</option>
                        <option value="month">Bulan Ini</option>
                        <option value="year">Tahun Ini</option>
                    </select>
                    <i class="fas fa-chevron-down absolute right-3 top-3.5 text-gray-400 pointer-events-none"></i>
                </div>
            </div>
        </div>

        <!-- Additional Filters -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
            <!-- Filter by Company -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-building text-bpjs-primary mr-1"></i>
                    Filter Perusahaan
                </label>
                <div class="relative">
                    <i class="fas fa-landmark absolute left-3 top-3.5 text-gray-400"></i>
                    <select id="companyFilter" class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-bpjs-accent/50 text-gray-700 transition appearance-none">
                        <option value="all">Semua Perusahaan</option>
                        <option value="PT Astra International">PT Astra International</option>
                        <option value="PT Telkom Indonesia">PT Telkom Indonesia</option>
                        <option value="PT Bank Central Asia">PT Bank Central Asia</option>
                        <option value="PT Unilever Indonesia">PT Unilever Indonesia</option>
                    </select>
                    <i class="fas fa-chevron-down absolute right-3 top-3.5 text-gray-400 pointer-events-none"></i>
                </div>
            </div>

            <!-- Sort by -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-sort text-bpjs-primary mr-1"></i>
                    Urutkan Berdasarkan
                </label>
                <div class="relative">
                    <i class="fas fa-sort-amount-down absolute left-3 top-3.5 text-gray-400"></i>
                    <select id="sortBy" class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-bpjs-accent/50 text-gray-700 transition appearance-none">
                        <option value="newest">Terbaru</option>
                        <option value="oldest">Terlama</option>
                        <option value="company">Nama Perusahaan</option>
                        <option value="amount">Jumlah Tertinggi</option>
                    </select>
                    <i class="fas fa-chevron-down absolute right-3 top-3.5 text-gray-400 pointer-events-none"></i>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-end">
                <button id="applyFilters" class="w-full md:w-auto px-4 py-3 bg-bpjs-primary text-white rounded-xl hover:bg-blue-800 transition font-medium">
                    Terapkan Filter
                </button>
                <button id="resetFilters" class="ml-2 px-4 py-3 border border-gray-300 text-gray-700 rounded-xl hover:bg-gray-50 transition font-medium">
                    Reset
                </button>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
        <div class="bg-white rounded-2xl shadow-sm p-4 border border-gray-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Total Data</p>
                    <h3 class="text-2xl font-bold text-gray-800">142</h3>
                </div>
                <div class="p-3 rounded-lg bg-blue-100">
                    <i class="fas fa-database text-blue-600 text-xl"></i>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-2xl shadow-sm p-4 border border-gray-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Total Nilai</p>
                    <h3 class="text-2xl font-bold text-gray-800">Rp 2,45M</h3>
                </div>
                <div class="p-3 rounded-lg bg-green-100">
                    <i class="fas fa-money-bill-wave text-green-600 text-xl"></i>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-2xl shadow-sm p-4 border border-gray-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Perusahaan</p>
                    <h3 class="text-2xl font-bold text-gray-800">24</h3>
                </div>
                <div class="p-3 rounded-lg bg-orange-100">
                    <i class="fas fa-building text-orange-600 text-xl"></i>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-2xl shadow-sm p-4 border border-gray-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Rata-rata/Bulan</p>
                    <h3 class="text-2xl font-bold text-gray-800">Rp 204Jt</h3>
                </div>
                <div class="p-3 rounded-lg bg-purple-100">
                    <i class="fas fa-chart-line text-purple-600 text-xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Data Table -->
    <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-200">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gradient-to-r from-bpjs-primary to-bpjs-darkblue text-white">
                    <tr>
                        <th class="p-4 text-left font-semibold">#</th>
                        <th class="p-4 text-left font-semibold">No. Penetapan</th>
                        <th class="p-4 text-left font-semibold">Tanggal</th>
                        <th class="p-4 text-left font-semibold">Kode Transaksi</th>
                        <th class="p-4 text-left font-semibold">No. KPJ</th>
                        <th class="p-4 text-left font-semibold">Perusahaan</th>
                        <th class="p-4 text-left font-semibold">PPH 21</th>
                        <th class="p-4 text-left font-semibold">Jumlah Bayar</th>
                        <th class="p-4 text-left font-semibold">Rekening</th>
                        <th class="p-4 text-left font-semibold">Atas Nama</th>
                        <th class="p-4 text-left font-semibold">Dokumen</th>
                        <th class="p-4 text-left font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <?php if (!empty($jaminan)): ?>
                        <?php $no = 1; foreach ($jaminan as $row): ?>
                            <tr class="hover:bg-gray-50 transition">
                                <td class="p-4"><?= $no++ ?></td>
                                <td class="p-4 font-medium text-bpjs-primary"><?= esc($row['nomor_penetapan']) ?></td>
                                <td class="p-4"><?= date('d/m/Y', strtotime($row['tanggal_transaksi'])) ?></td>
                                <td class="p-4"><?= esc($row['kode_transaksi']) ?></td>
                                <td class="p-4"><?= esc($row['nomor_kpj']) ?></td>
                                <td class="p-4">
                                    <div class="flex items-center">
                                        <div class="p-2 rounded-lg bg-blue-100 mr-2">
                                            <i class="fas fa-building text-blue-600"></i>
                                        </div>
                                        <?= esc($row['nama_perusahaan']) ?>
                                    </div>
                                </td>
                                <td class="p-4">Rp <?= number_format($row['pph21'], 2, ',', '.') ?></td>
                                <td class="p-4">
                                    <span class="px-3 py-1 rounded-full bg-green-100 text-green-800 text-sm font-medium">
                                        Rp <?= number_format($row['jumlah_bayar'], 2, ',', '.') ?>
                                    </span>
                                </td>
                                <td class="p-4"><?= esc($row['no_rekening']) ?></td>
                                <td class="p-4"><?= esc($row['atas_nama']) ?></td>
                                <td class="p-4">
                                    <?php if ($row['dokumen']): ?>
                                        <a href="<?= base_url('uploads/' . $row['dokumen']) ?>" target="_blank" class="inline-flex items-center px-3 py-2 rounded-lg bg-blue-100 text-blue-700 hover:bg-blue-200 transition">
                                            <i class="fas fa-file-pdf mr-2"></i> Lihat
                                        </a>
                                    <?php else: ?>
                                        <span class="inline-flex items-center px-3 py-2 rounded-lg bg-gray-100 text-gray-600">
                                            <i class="fas fa-times-circle mr-2"></i> Tidak ada
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td class="p-4">
                                    <div class="flex space-x-2">
                                        <button class="p-2 rounded-lg bg-blue-100 text-blue-600 hover:bg-blue-200 transition" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="p-2 rounded-lg bg-red-100 text-red-600 hover:bg-red-200 transition" title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="12" class="p-8 text-center">
                                <div class="flex flex-col items-center justify-center text-gray-400 py-8">
                                    <i class="fas fa-inbox text-4xl mb-3"></i>
                                    <p class="text-lg">Tidak ada data jaminan</p>
                                    <p class="text-sm mt-1">Klik "Tambah Data" untuk menambahkan data baru</p>
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    <div class="flex justify-between items-center mt-6">
        <div class="text-sm text-gray-600">
            Menampilkan 1 sampai 10 dari 142 entri
        </div>
        <div class="flex space-x-2">
            <button class="px-4 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-50 transition">
                <i class="fas fa-chevron-left"></i>
            </button>
            <button class="px-4 py-2 rounded-lg bg-bpjs-primary text-white">1</button>
            <button class="px-4 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-50 transition">2</button>
            <button class="px-4 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-50 transition">3</button>
            <button class="px-4 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-50 transition">
                <i class="fas fa-chevron-right"></i>
            </button>
        </div>
    </div>
</div>

<style>
    table th, table td {
        border-bottom: 1px solid #e5e7eb;
    }
    
    table th {
        font-weight: 600;
        font-size: 0.875rem;
    }
    
    .btn-filter:hover {
        background-color: #1c5ca4;
        color: white;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('searchInput');
        const dateFilter = document.getElementById('dateFilter');
        const companyFilter = document.getElementById('companyFilter');
        const sortBy = document.getElementById('sortBy');
        const applyFilters = document.getElementById('applyFilters');
        const resetFilters = document.getElementById('resetFilters');
        
        // Search functionality
        searchInput.addEventListener('keyup', function() {
            const searchText = this.value.toLowerCase();
            const rows = document.querySelectorAll('tbody tr');
            
            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                if (text.includes(searchText)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
        
        // Apply filters
        applyFilters.addEventListener('click', function() {
            // In a real application, this would send a request to the server
            // For demonstration, we'll just show a message
            alert('Filter diterapkan: ' + 
                  '\nTanggal: ' + dateFilter.options[dateFilter.selectedIndex].text +
                  '\nPerusahaan: ' + companyFilter.options[companyFilter.selectedIndex].text +
                  '\nUrutkan: ' + sortBy.options[sortBy.selectedIndex].text);
        });
        
        // Reset filters
        resetFilters.addEventListener('click', function() {
            searchInput.value = '';
            dateFilter.value = 'all';
            companyFilter.value = 'all';
            sortBy.value = 'newest';
            
            // Show all rows
            const rows = document.querySelectorAll('tbody tr');
            rows.forEach(row => {
                row.style.display = '';
            });
        });
    });
</script>
<?= $this->endSection() ?>