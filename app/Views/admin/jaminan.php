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
       <a 
            href="<?= site_url('admin/tambah_jaminan') ?>" 
            class="flex items-center gap-2 px-4 py-2.5 rounded-xl bg-gradient-to-r from-bpjs-accent to-orange-500 text-white font-semibold hover:opacity-90 shadow-lg transition"
        >
            <i class="fas fa-plus"></i>
            Tambah Data
        </a>

    </div>

    <!-- Search and Filter Section -->
    <div class="bg-white rounded-2xl shadow-sm p-5 mb-6 border border-gray-200">
        <form method="get" action="<?= site_url('/admin/jaminan/filter') ?>" class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <!-- Search Input -->
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-search text-bpjs-primary mr-1"></i>
                    Cari Data
                </label>
                <div class="relative">
                    <i class="fas fa-search absolute left-3 top-3.5 text-gray-400"></i>
                    <input 
                        type="text" 
                        name="search" 
                        placeholder="Cari berdasarkan no. penetapan atau no. KPJ..." 
                        class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-bpjs-accent/50 text-gray-700 transition"
                        value="<?= esc($search) ?>"
                    >
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
                    <select 
                        name="date" 
                        class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-bpjs-accent/50 text-gray-700 transition appearance-none"
                    >
                        <option value="all"   <?= ($date=='all')?'selected':'' ?>>Semua Tanggal</option>
                        <option value="today" <?= ($date=='today')?'selected':'' ?>>Hari Ini</option>
                        <option value="week"  <?= ($date=='week')?'selected':'' ?>>Minggu Ini</option>
                        <option value="month" <?= ($date=='month')?'selected':'' ?>>Bulan Ini</option>
                        <option value="year"  <?= ($date=='year')?'selected':'' ?>>Tahun Ini</option>
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
                    <select 
                        name="sortBy"
                        class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-bpjs-accent/50 text-gray-700 transition appearance-none"
                    >
                        <option value="newest"      <?= ($sortBy=='newest')?'selected':'' ?>>Terbaru</option>
                        <option value="oldest"      <?= ($sortBy=='oldest')?'selected':'' ?>>Terlama</option>
                        <option value="amount_desc" <?= ($sortBy=='amount_desc')?'selected':'' ?>>Jumlah Tertinggi</option>
                        <option value="amount_asc"  <?= ($sortBy=='amount_asc')?'selected':'' ?>>Jumlah Terendah</option>
                    </select>
                    <i class="fas fa-chevron-down absolute right-3 top-3.5 text-gray-400 pointer-events-none"></i>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-end col-span-2 md:col-span-1">
                <button 
                    type="submit"
                    class="w-full md:w-auto px-4 py-3 bg-bpjs-primary text-white rounded-xl hover:bg-blue-800 transition font-medium"
                >
                    Terapkan Filter
                </button>
                <a 
                    href="<?= site_url('admin/jaminan') ?>" 
                    class="ml-2 px-4 py-3 border border-gray-300 text-gray-700 rounded-xl hover:bg-gray-50 transition font-medium"
                >
                    Reset
                </a>
            </div>
        </form>
        
        <!-- Import Excel/CSV - Revisi -->
        <div class="mt-6 pt-6 border-t border-gray-200">
            <h3 class="text-lg font-medium text-gray-700 mb-3">
                <i class="fas fa-file-import text-bpjs-primary mr-2"></i>
                Import Data Excel
            </h3>
            <form action="<?= site_url('admin/jaminan/import_jaminan') ?>" method="post" enctype="multipart/form-data" class="flex flex-col md:flex-row items-start md:items-center gap-4">
                <div class="relative flex-grow">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Pilih File Excel/CSV
                    </label>
                    <div class="relative">
                        <input 
                            type="file" 
                            name="file_excel" 
                            id="file_excel"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-bpjs-accent/50 text-gray-700 transition file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100"
                            accept=".xls,.xlsx,.csv"
                            required
                        >
                    </div>
                </div>
                <div class="flex-shrink-0 mt-5 md:mt-0">
                    <button 
                        type="submit"
                        class="px-6 py-3 bg-green-600 text-white rounded-xl hover:bg-green-700 transition font-medium flex items-center gap-2"
                    >
                        <i class="fas fa-file-excel"></i> Import Data
                    </button>
                </div>
            </form>
           
        </div>
    </div>


    <!-- Stats Cards -->
   <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
    <!-- Total Data -->
        <div class="bg-white rounded-2xl shadow-sm p-4 border border-gray-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Total Data</p>
                    <h3 class="text-2xl font-bold text-gray-800"><?= number_format($totalData) ?></h3>
                </div>
                <div class="p-3 rounded-lg bg-blue-100">
                    <i class="fas fa-database text-blue-600 text-xl"></i>
                </div>
            </div>
        </div>

        <!-- Total Nilai -->
        <div class="bg-white rounded-2xl shadow-sm p-4 border border-gray-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Total Nilai</p>
                    <h3 class="text-2xl font-bold text-gray-800">
                        Rp <?= number_format($totalNilai, 2, ',', '.') ?>
                    </h3>
                </div>
                <div class="p-3 rounded-lg bg-green-100">
                    <i class="fas fa-money-bill-wave text-green-600 text-xl"></i>
                </div>
            </div>
        </div>

        <!-- Total Perusahaan -->
        <div class="bg-white rounded-2xl shadow-sm p-4 border border-gray-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Perusahaan</p>
                    <h3 class="text-2xl font-bold text-gray-800"><?= number_format($totalPerusahaan) ?></h3>
                </div>
                <div class="p-3 rounded-lg bg-orange-100">
                    <i class="fas fa-building text-orange-600 text-xl"></i>
                </div>
            </div>
        </div>

        <!-- Rata-rata/Bulan -->
        <div class="bg-white rounded-2xl shadow-sm p-4 border border-gray-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Rata-rata/Bulan</p>
                    <h3 class="text-2xl font-bold text-gray-800">
                        Rp <?= number_format($rataRata, 2, ',', '.') ?>
                    </h3>
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
                                    <?php 
                                        $filePath = FCPATH . 'uploads/jaminan/' . ($row['dokumen'] ?? '');
                                        if (!empty($row['dokumen']) && file_exists($filePath)): 
                                    ?>
                                        <a href="<?= base_url('uploads/jaminan/' . $row['dokumen']) ?>" target="_blank"
                                        class="inline-flex items-center px-3 py-2 rounded-lg bg-blue-100 text-blue-700 hover:bg-blue-200 transition">
                                            <i class="fas fa-image mr-2"></i> Lihat
                                        </a>
                                    <?php else: ?>
                                        <button type="button" onclick="showNoFileToast()" 
                                            class="inline-flex items-center px-3 py-2 rounded-lg bg-gray-100 text-gray-600">
                                            <i class="fas fa-times-circle mr-2"></i> Tidak ada
                                        </button>
                                    <?php endif; ?>
                                </td>



                               <td class="p-4">
                                    <div class="flex space-x-2">
                                        <!-- Tombol Detail -->
                                        <button 
                                            class="p-2 rounded-lg bg-green-100 text-green-600 hover:bg-green-200 transition btn-detail"
                                            data-id="<?= $row['id'] ?>"
                                            data-nomor_penetapan="<?= esc($row['nomor_penetapan']) ?>"
                                            data-tanggal_transaksi="<?= esc($row['tanggal_transaksi']) ?>"
                                            data-kode_transaksi="<?= esc($row['kode_transaksi']) ?>"
                                            data-nomor_kpj="<?= esc($row['nomor_kpj']) ?>"
                                            data-nama_perusahaan="<?= esc($row['nama_perusahaan']) ?>"
                                            data-pph21="<?= esc($row['pph21']) ?>"
                                            data-jumlah_bayar="<?= esc($row['jumlah_bayar']) ?>"
                                            data-no_rekening="<?= esc($row['no_rekening']) ?>"
                                            data-atas_nama="<?= esc($row['atas_nama']) ?>"
                                            data-dokumen="<?= esc($row['dokumen']) ?>"
                                            title="Detail">
                                            <i class="fas fa-eye"></i>
                                        </button>

                                        <!-- Tombol Edit -->
                                        <button 
                                            class="p-2 rounded-lg bg-blue-100 text-blue-600 hover:bg-blue-200 transition btn-edit"
                                            data-id="<?= $row['id'] ?>"
                                            data-nomor_penetapan="<?= esc($row['nomor_penetapan']) ?>"
                                            data-tanggal_transaksi="<?= esc($row['tanggal_transaksi']) ?>"
                                            data-kode_transaksi="<?= esc($row['kode_transaksi']) ?>"
                                            data-nomor_kpj="<?= esc($row['nomor_kpj']) ?>"
                                            data-nama_perusahaan="<?= esc($row['nama_perusahaan']) ?>"
                                            data-pph21="<?= esc($row['pph21']) ?>"
                                            data-jumlah_bayar="<?= esc($row['jumlah_bayar']) ?>"
                                            data-no_rekening="<?= esc($row['no_rekening']) ?>"
                                            data-atas_nama="<?= esc($row['atas_nama']) ?>"
                                            title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </button>

                                        <!-- Tombol Hapus -->
                                        <form action="<?= base_url('admin/jaminan/delete/'.$row['id']) ?>" method="post" onsubmit="return confirm('Yakin mau hapus data ini?')" class="inline">
                                            <?= csrf_field() ?>
                                            <button type="submit" class="p-2 rounded-lg bg-red-100 text-red-600 hover:bg-red-200 transition" title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
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

   


    <!-- Modal -->
    <div id="modalEdit" class="fixed inset-0 z-50 hidden bg-black bg-opacity-50 flex items-center justify-center">
        <div class="bg-white rounded-xl shadow-lg w-full max-w-2xl p-6">
            <h2 class="text-xl font-semibold mb-4">Edit Data Jaminan</h2>

            <form id="formEdit" action="<?= base_url('admin/jaminan/update') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <input type="hidden" name="id" id="edit_id">

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium">No. Penetapan</label>
                        <input type="text" name="nomor_penetapan" id="edit_nomor_penetapan" class="w-full border rounded-lg p-2">
                    </div>
                    <div>
                        <label class="block text-sm font-medium">Tanggal</label>
                        <input type="date" name="tanggal_transaksi" id="edit_tanggal_transaksi" class="w-full border rounded-lg p-2">
                    </div>
                    <div>
                        <label class="block text-sm font-medium">Kode Transaksi</label>
                        <input type="text" name="kode_transaksi" id="edit_kode_transaksi" class="w-full border rounded-lg p-2">
                    </div>
                    <div>
                        <label class="block text-sm font-medium">No. KPJ</label>
                        <input type="text" name="nomor_kpj" id="edit_nomor_kpj" class="w-full border rounded-lg p-2">
                    </div>
                    <div class="col-span-2">
                        <label class="block text-sm font-medium">Perusahaan</label>
                        <input type="text" name="nama_perusahaan" id="edit_nama_perusahaan" class="w-full border rounded-lg p-2">
                    </div>
                    <div>
                        <label class="block text-sm font-medium">PPH 21</label>
                        <input type="number" step="0.01" name="pph21" id="edit_pph21" class="w-full border rounded-lg p-2">
                    </div>
                    <div>
                        <label class="block text-sm font-medium">Jumlah Bayar</label>
                        <input type="number" step="0.01" name="jumlah_bayar" id="edit_jumlah_bayar" class="w-full border rounded-lg p-2">
                    </div>
                    <div>
                        <label class="block text-sm font-medium">Rekening</label>
                        <input type="text" name="no_rekening" id="edit_no_rekening" class="w-full border rounded-lg p-2">
                    </div>
                    <div>
                        <label class="block text-sm font-medium">Atas Nama</label>
                        <input type="text" name="atas_nama" id="edit_atas_nama" class="w-full border rounded-lg p-2">
                    </div>
                    <div class="col-span-2">
                        <label class="block text-sm font-medium">Dokumen (opsional)</label>
                        <input type="file" name="dokumen" class="w-full border rounded-lg p-2">
                    </div>
                </div>

                <div class="flex justify-end mt-6 space-x-2">
                    <button type="button" onclick="closeModal()" class="px-4 py-2 rounded-lg bg-gray-200 hover:bg-gray-300">Batal</button>
                    <button type="submit" class="px-4 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal dua -->
     <!-- Modal Detail -->
    <div id="modalDetail" class="fixed inset-0 hidden bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-2xl p-6 relative">
            <button class="absolute top-2 right-2 text-gray-600 hover:text-gray-900" id="closeModalDetail">
                <i class="fas fa-times"></i>
            </button>
            <h2 class="text-lg font-semibold mb-4">Detail Jaminan</h2>
            <div class="space-y-2">
                <p><strong>Nomor Penetapan:</strong> <span id="detailNomorPenetapan"></span></p>
                <p><strong>Tanggal Transaksi:</strong> <span id="detailTanggal"></span></p>
                <p><strong>Kode Transaksi:</strong> <span id="detailKode"></span></p>
                <p><strong>Nomor KPJ:</strong> <span id="detailKpj"></span></p>
                <p><strong>Nama Perusahaan:</strong> <span id="detailPerusahaan"></span></p>
                <p><strong>PPH21:</strong> <span id="detailPph21"></span></p>
                <p><strong>Jumlah Bayar:</strong> <span id="detailJumlah"></span></p>
                <p><strong>No Rekening:</strong> <span id="detailRekening"></span></p>
                <p><strong>Atas Nama:</strong> <span id="detailAtasNama"></span></p>
                <p><strong>Dokumen:</strong> <span id="detailDokumen"></span></p>
            </div>
        </div>
    </div>


</div>


<script>
    const modal = document.getElementById("modalEdit");
    const btnsEdit = document.querySelectorAll(".btn-edit");

    btnsEdit.forEach(btn => {
        btn.addEventListener("click", () => {
            document.getElementById("edit_id").value = btn.dataset.id;
            document.getElementById("edit_nomor_penetapan").value = btn.dataset.nomor_penetapan;
            document.getElementById("edit_tanggal_transaksi").value = btn.dataset.tanggal_transaksi;
            document.getElementById("edit_kode_transaksi").value = btn.dataset.kode_transaksi;
            document.getElementById("edit_nomor_kpj").value = btn.dataset.nomor_kpj;
            document.getElementById("edit_nama_perusahaan").value = btn.dataset.nama_perusahaan;
            document.getElementById("edit_pph21").value = btn.dataset.pph21;
            document.getElementById("edit_jumlah_bayar").value = btn.dataset.jumlah_bayar;
            document.getElementById("edit_no_rekening").value = btn.dataset.no_rekening;
            document.getElementById("edit_atas_nama").value = btn.dataset.atas_nama;

            modal.classList.remove("hidden");
        });
    });

    function closeModal() {
        modal.classList.add("hidden");
    }
</script>

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
function showNoFileToast() {
    Swal.fire({
        toast: true,
        position: 'top-end',
        icon: 'warning',
        title: 'Dokumen tidak tersedia',
        showConfirmButton: false,
        timer: 2000,
        timerProgressBar: true
    });
}
</script>

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


<script>
document.getElementById("applyFilters").addEventListener("click", function() {
    const search  = document.getElementById("searchInput").value;
    const date    = document.getElementById("dateFilter").value;
    const company = document.getElementById("companyFilter").value;
    const sortBy  = document.getElementById("sortBy").value;

    fetch(`/admin/jaminan/filter?search=${search}&date=${date}&company=${company}&sortBy=${sortBy}`)
        .then(res => res.json())
        .then(data => {
            const tbody = document.querySelector("table tbody");
            tbody.innerHTML = "";

            if (data.length === 0) {
                tbody.innerHTML = `
                    <tr>
                        <td colspan="12" class="p-8 text-center text-gray-500">Tidak ada data ditemukan</td>
                    </tr>
                `;
                return;
            }

            data.forEach((row, i) => {
                tbody.innerHTML += `
                    <tr class="hover:bg-gray-50 transition">
                        <td class="p-4">${i+1}</td>
                        <td class="p-4 font-medium text-bpjs-primary">${row.nomor_penetapan}</td>
                        <td class="p-4">${new Date(row.tanggal_transaksi).toLocaleDateString('id-ID')}</td>
                        <td class="p-4">${row.kode_transaksi}</td>
                        <td class="p-4">${row.nomor_kpj}</td>
                        <td class="p-4">${row.nama_perusahaan}</td>
                        <td class="p-4">Rp ${parseFloat(row.pph21).toLocaleString('id-ID')}</td>
                        <td class="p-4">Rp ${parseFloat(row.jumlah_bayar).toLocaleString('id-ID')}</td>
                        <td class="p-4">${row.no_rekening}</td>
                        <td class="p-4">${row.atas_nama}</td>
                        <td class="p-4">${row.dokumen ? `<a href="/uploads/${row.dokumen}" target="_blank">Lihat</a>` : 'Tidak ada'}</td>
                        <td class="p-4">
                            <button class="p-2 rounded-lg bg-blue-100 text-blue-600 hover:bg-blue-200">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="p-2 rounded-lg bg-red-100 text-red-600 hover:bg-red-200">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                `;
            });
        });
});

// Reset filter
document.getElementById("resetFilters").addEventListener("click", function() {
    document.getElementById("searchInput").value = "";
    document.getElementById("dateFilter").value = "all";
    document.getElementById("companyFilter").value = "all";
    document.getElementById("sortBy").value = "newest";
    document.getElementById("applyFilters").click();
});
</script>


<script>
document.addEventListener("DOMContentLoaded", function() {
    <?php if (session()->getFlashdata('success')): ?>
        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: 'success',
            title: '<?= session()->getFlashdata('success') ?>',
            showConfirmButton: false,
            timer: 2000,
            timerProgressBar: true
        });
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: 'error',
            title: '<?= session()->getFlashdata('error') ?>',
            showConfirmButton: false,
            timer: 2000,
            timerProgressBar: true
        });
    <?php endif; ?>
});
</script>


<script>
document.addEventListener("DOMContentLoaded", function() {
    const modalDetail = document.getElementById("modalDetail");
    const closeModalDetail = document.getElementById("closeModalDetail");

    document.querySelectorAll(".btn-detail").forEach(btn => {
        btn.addEventListener("click", function() {
            document.getElementById("detailNomorPenetapan").textContent = this.dataset.nomor_penetapan;
            document.getElementById("detailTanggal").textContent = this.dataset.tanggal_transaksi;
            document.getElementById("detailKode").textContent = this.dataset.kode_transaksi;
            document.getElementById("detailKpj").textContent = this.dataset.nomor_kpj;
            document.getElementById("detailPerusahaan").textContent = this.dataset.nama_perusahaan;
            document.getElementById("detailPph21").textContent = this.dataset.pph21;
            document.getElementById("detailJumlah").textContent = this.dataset.jumlah_bayar;
            document.getElementById("detailRekening").textContent = this.dataset.no_rekening;
            document.getElementById("detailAtasNama").textContent = this.dataset.atas_nama;

           if(this.dataset.dokumen){
                let fileUrl = "<?= base_url('uploads/jaminan/') ?>" + this.dataset.dokumen;
                let ext = this.dataset.dokumen.split('.').pop().toLowerCase();

                if(['jpg','jpeg','png','gif'].includes(ext)){
                    document.getElementById("detailDokumen").innerHTML = `
                        <img src="${fileUrl}" alt="Dokumen" class="max-h-64 rounded border">
                    `;
                } else if(ext === 'pdf') {
                    document.getElementById("detailDokumen").innerHTML = `
                        <iframe src="${fileUrl}" class="w-full h-64 border rounded"></iframe>
                    `;
                } else {
                    document.getElementById("detailDokumen").innerHTML = `
                        <a href="${fileUrl}" target="_blank" class="text-blue-600 hover:underline">
                            Lihat Dokumen
                        </a>
                    `;
                }
            } else {
                document.getElementById("detailDokumen").textContent = "Tidak ada dokumen";
            }


            modalDetail.classList.remove("hidden");
        });
    });

    closeModalDetail.addEventListener("click", () => {
        modalDetail.classList.add("hidden");
    });
});
</script>

<?= $this->endSection() ?>