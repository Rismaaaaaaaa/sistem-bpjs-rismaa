<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="p-6 mt-12">
    <!-- Header -->
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-bpjs-primary flex items-center gap-3">
                <div class="p-2 rounded-lg bg-bpjs-accent/10">
                    <i class="fas fa-money-check-alt text-bpjs-accent text-xl"></i>
                </div>
                Data BUBM BPJS
            </h1>
            <p class="text-gray-600 mt-2 ml-11">Kelola data BUBM BPJS Ketenagakerjaan</p>
        </div>
        <a href="<?= site_url('/admin/tambah_bubm') ?>" class="flex items-center gap-2 px-4 py-2.5 rounded-xl bg-gradient-to-r from-bpjs-accent to-orange-500 text-white font-semibold hover:opacity-90 shadow-lg transition">
            <i class="fas fa-plus"></i>
            Tambah Data
        </a>
    </div>

    

    <!-- Search and Filter Section -->
    <div class="bg-white rounded-2xl shadow-sm p-5 mb-6 border border-gray-200">
        <form method="get" action="<?= site_url('/admin/bubm/filter') ?>" class="grid grid-cols-1 md:grid-cols-4 gap-4">
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
                        placeholder="Cari berdasarkan kode transaksi, voucher, atau program..." 
                        class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-bpjs-accent/50 text-gray-700 transition"
                        value="<?= esc($search ?? '') ?>"
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
                        <option value="all" <?= ($date ?? 'all') == 'all' ? 'selected' : '' ?>>Semua Tanggal</option>
                        <option value="today" <?= ($date ?? '') == 'today' ? 'selected' : '' ?>>Hari Ini</option>
                        <option value="week" <?= ($date ?? '') == 'week' ? 'selected' : '' ?>>Minggu Ini</option>
                        <option value="month" <?= ($date ?? '') == 'month' ? 'selected' : '' ?>>Bulan Ini</option>
                        <option value="year" <?= ($date ?? '') == 'year' ? 'selected' : '' ?>>Tahun Ini</option>
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
                        <option value="newest" <?= ($sortBy ?? 'newest') == 'newest' ? 'selected' : '' ?>>Terbaru</option>
                        <option value="oldest" <?= ($sortBy ?? '') == 'oldest' ? 'selected' : '' ?>>Terlama</option>
                        <option value="amount_desc" <?= ($sortBy ?? '') == 'amount_desc' ? 'selected' : '' ?>>Jumlah Tertinggi</option>
                        <option value="amount_asc" <?= ($sortBy ?? '') == 'amount_asc' ? 'selected' : '' ?>>Jumlah Terendah</option>
                    </select>
                    <i class="fas fa-chevron-down absolute right-3 top-3.5 text-gray-400 pointer-events-none"></i>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-end col-span-2 md:col-span-4 gap-2">
                <button 
                    type="submit"
                    class="w-full md:w-auto px-4 py-3 bg-bpjs-primary text-white rounded-xl hover:bg-blue-800 transition font-medium flex items-center gap-2"
                >
                    <i class="fas fa-filter"></i> Terapkan Filter
                </button>
                <a 
                    href="<?= site_url('admin/bubm') ?>" 
                    class="w-full md:w-auto px-4 py-3 border border-gray-300 text-gray-700 rounded-xl hover:bg-gray-50 transition font-medium flex items-center gap-2"
                >
                    <i class="fas fa-sync"></i> Reset
                </a>
                <a 
                    href="<?= site_url('admin/bubm/exportExcel?search=' . urlencode($search) . '&date=' . urlencode($date) . '&sortBy=' . urlencode($sortBy)) ?>" 
                    class="w-full md:w-auto px-4 py-3 bg-green-600 text-white rounded-xl hover:bg-green-700 transition font-medium flex items-center gap-2"
                >
                    <i class="fas fa-file-excel"></i> Export Excel
                </a>
            </div>

        </form>
        
        <!-- Import Excel/CSV -->
        <div class="my-6 pt-6 border-t border-gray-200"><div class="mt-6 pt-6 border-t border-gray-200">
            <h3 class="text-lg font-medium text-gray-700 mb-3 flex items-center gap-2">
                <i class="fas fa-file-import text-bpjs-primary mr-2"></i>
                Import Data Excel
            </h3>
            <form action="<?= site_url('admin/bubm/import') ?>" method="post" enctype="multipart/form-data" class="flex flex-col md:flex-row items-start md:items-center gap-4">
                <div class="relative flex-grow">
                    <label for="file_excel" class="block text-sm font-medium text-gray-700 mb-2">
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
                        <div id="fileName" class="text-sm text-gray-600 mt-2 hidden"></div>
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
                    <h3 class="text-2xl font-bold text-gray-800"><?= number_format(count($bubm)) ?></h3>
                </div>
                <div class="p-3 rounded-lg bg-blue-100">
                    <i class="fas fa-database text-blue-600 text-xl"></i>
                </div>
            </div>
        </div>
        
        <!-- Total Rupiah -->
        <div class="bg-white rounded-2xl shadow-sm p-4 border border-gray-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Total Rupiah</p>
                    <h3 class="text-2xl font-bold text-gray-800">
                        Rp <?= isset($totalRupiah) ? number_format($totalRupiah, 0, ',', '.') : '0' ?>
                    </h3>
                </div>
                <div class="p-3 rounded-lg bg-green-100">
                    <i class="fas fa-money-bill-wave text-green-600 text-xl"></i>
                </div>
            </div>
        </div>
        
        <!-- Rata-rata BUBM -->
        <div class="bg-white rounded-2xl shadow-sm p-4 border border-gray-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Rata-rata BUBM</p>
                    <h3 class="text-2xl font-bold text-gray-800">
                        Rp <?= isset($bubm) && count($bubm) > 0 ? number_format($totalRupiah / count($bubm), 0, ',', '.') : '0' ?>
                    </h3>
                </div>
                <div class="p-3 rounded-lg bg-orange-100">
                    <i class="fas fa-calculator text-orange-600 text-xl"></i>
                </div>
            </div>
        </div>
        
        <!-- Program Terbanyak -->
        <div class="bg-white rounded-2xl shadow-sm p-4 border border-gray-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Program</p>
                    <h3 class="text-2xl font-bold text-gray-800">12</h3>
                </div>
                <div class="p-3 rounded-lg bg-purple-100">
                    <i class="fas fa-list-alt text-purple-600 text-xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabel Data -->
    <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-200">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gradient-to-r from-bpjs-primary to-bpjs-darkblue text-white">
                    <tr>
                        <th class="p-4 text-left font-semibold">#</th>
                        <th class="p-4 text-left font-semibold">Kode Transaksi Voucher</th>
                        <th class="p-4 text-left font-semibold">Program</th>
                        <th class="p-4 text-left font-semibold">Nomor Rak</th>
                        <th class="p-4 text-left font-semibold">Nomor Baris</th>
                        <th class="p-4 text-left font-semibold">Jumlah Rupiah</th>
                        <th class="p-4 text-left font-semibold">Keterangan Transaksi</th>
                        <th class="p-4 text-left font-semibold">Dokumen</th>
                        <th class="p-4 text-left font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <?php if (!empty($bubm)): ?>
                        <?php $no = 1; foreach ($bubm as $row): ?>
                            <tr class="hover:bg-gray-50 transition">
                                <td class="p-4"><?= $no++ ?></td>
                                <td class="p-4 font-medium text-bpjs-primary"><?= esc($row['kode_transaksi']) ?></td>
                                <td class="p-4">
                                    <div class="flex items-center">
                                        <div class="p-2 rounded-lg bg-indigo-100 mr-2">
                                            <i class="fas fa-list-alt text-indigo-600"></i>
                                        </div>
                                        <?= esc($row['program']) ?>
                                    </div>
                                </td>
                                <td class="p-4"><?= esc($row['nomor_rak']) ?></td>
                                <td class="p-4"><?= esc($row['nomor_baris']) ?></td>
                                <td class="p-4">
                                    <span class="px-3 py-1 rounded-full bg-green-100 text-green-800 text-sm font-medium">
                                        Rp <?= number_format($row['jumlah_rupiah'], 0, ',', '.') ?>
                                    </span>
                                </td>
                                <td class="p-4">
                                    <?php if ($row['keterangan']): ?>
                                        <div class="max-w-xs truncate" title="<?= esc($row['keterangan']) ?>">
                                            <?= esc($row['keterangan']) ?>
                                        </div>
                                    <?php else: ?>
                                        <span class="text-gray-400">-</span>
                                    <?php endif; ?>
                                </td>
                                <td class="p-4">
                                    <?php 
                                        $filePath = FCPATH . 'Uploads/bubm/' . ($row['dokumen'] ?? '');
                                        if (!empty($row['dokumen']) && file_exists($filePath)): 
                                            $fileUrl = base_url('Uploads/bubm/' . $row['dokumen']);
                                    ?>
                                        <button type="button" 
                                                onclick="showBubmImageModal('<?= $fileUrl ?>', '<?= $row['dokumen'] ?>')" 
                                                class="inline-flex items-center px-3 py-2 rounded-lg bg-blue-100 text-blue-700 hover:bg-blue-200 transition">
                                            <i class="fas fa-image mr-2"></i> Lihat
                                        </button>
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
                                            type="button"
                                            class="p-2 rounded-lg bg-blue-100 text-blue-600 hover:bg-blue-200 transition btn-detail-bubm"
                                            data-id="<?= $row['id'] ?>"
                                            data-kode_transaksi="<?= esc($row['kode_transaksi']) ?>"
                                            data-voucher="<?= esc($row['voucher']) ?>"
                                            data-program="<?= esc($row['program']) ?>"
                                            data-nomor_rak="<?= esc($row['nomor_rak']) ?>"
                                            data-nomor_baris="<?= esc($row['nomor_baris']) ?>"
                                            data-jumlah_rupiah="<?= esc(number_format($row['jumlah_rupiah'], 0, ',', '.')) ?>"
                                            data-keterangan="<?= esc($row['keterangan']) ?>"
                                            data-dokumen="<?= !empty($row['dokumen']) ? esc(base_url('uploads/bubm/' . $row['dokumen'])) : '' ?>"
                                            data-tanggal_transaksi="<?= esc($row['tanggal_transaksi']) ?>"
                                            title="Lihat Detail Data BUBM"
                                        >
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <!-- Tombol Edit -->
                                        <button 
                                            class="p-2 rounded-lg bg-yellow-100 text-yellow-600 hover:bg-yellow-200 transition btn-edit-bubm"
                                            data-id="<?= $row['id'] ?>"
                                            data-kode_transaksi="<?= esc($row['kode_transaksi']) ?>"
                                            data-voucher="<?= esc($row['voucher']) ?>"
                                            data-program="<?= esc($row['program']) ?>"
                                            data-nomor_rak="<?= esc($row['nomor_rak']) ?>"
                                            data-nomor_baris="<?= esc($row['nomor_baris']) ?>"
                                            data-jumlah_rupiah="<?= esc($row['jumlah_rupiah']) ?>"
                                            data-keterangan="<?= esc($row['keterangan']) ?>"
                                            data-dokumen="<?= !empty($row['dokumen']) ? esc(base_url('uploads/bubm/' . $row['dokumen'])) : '' ?>"
                                            data-tanggal_transaksi="<?= esc($row['tanggal_transaksi']) ?>"
                                            title="Edit Data BUBM"
                                        >
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <!-- Tombol Hapus -->
                                        <form action="<?= base_url('admin/bubm/delete/' . $row['id']) ?>" method="post" onsubmit="return confirm('Yakin ingin menghapus data ini?')" class="inline">
                                            <?= csrf_field() ?>
                                            <button type="submit" class="p-2 rounded-lg bg-red-100 text-red-600 hover:bg-red-200 transition" title="Hapus Data BUBM">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="9" class="p-8 text-center">
                                <div class="flex flex-col items-center justify-center text-gray-400 py-8">
                                    <i class="fas fa-inbox text-4xl mb-3"></i>
                                    <p class="text-lg">Tidak ada data BUBM</p>
                                    <p class="text-sm mt-1">Klik "Tambah Data" untuk menambahkan data baru</p>
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

   
</div>


<!-- Modal Detail BUBM -->
<div id="modalDetailBubm" 
     class="fixed inset-0 hidden bg-black bg-opacity-70 flex items-center justify-center z-50 p-4 backdrop-blur-sm transition-opacity duration-300">
  
  <div class="bg-white rounded-xl shadow-2xl w-full max-w-2xl overflow-hidden transform transition-transform duration-300 scale-95">
      
      <!-- Header -->
      <div class="bg-gradient-to-r from-blue-600 to-indigo-700 px-6 py-4 flex justify-between items-center">
          <h2 class="text-xl font-bold text-white">Detail Data BUBM</h2>
          <button type="button" id="closeModalDetailBubm" 
                  class="text-white hover:text-blue-200 transition-colors duration-200 rounded-full p-1 hover:bg-blue-500/30">
              <i class="fas fa-times text-lg"></i>
          </button>
      </div>

      <!-- Content -->
      <div class="p-6 max-h-[70vh] overflow-y-auto">
          <div class="space-y-4">
              <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                  <div class="bg-blue-50 p-4 rounded-lg border border-blue-100">
                      <p class="text-sm text-blue-600 font-medium mb-1">Kode Transaksi</p>
                      <p id="detail_kode_transaksi" class="text-gray-800 font-semibold">-</p>
                  </div>
                  <div class="bg-blue-50 p-4 rounded-lg border border-blue-100">
                      <p class="text-sm text-blue-600 font-medium mb-1">Voucher</p>
                      <p id="detail_voucher" class="text-gray-800 font-semibold">-</p>
                  </div>
                  <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                      <p class="text-sm text-gray-600 font-medium mb-1">Program</p>
                      <p id="detail_program" class="text-gray-800 font-semibold">-</p>
                  </div>
                  <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                      <p class="text-sm text-gray-600 font-medium mb-1">Nomor Rak</p>
                      <p id="detail_nomor_rak" class="text-gray-800 font-semibold">-</p>
                  </div>
                  <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                      <p class="text-sm text-gray-600 font-medium mb-1">Nomor Baris</p>
                      <p id="detail_nomor_baris" class="text-gray-800 font-semibold">-</p>
                  </div>
                  <div class="bg-green-50 p-4 rounded-lg border border-green-200">
                      <p class="text-sm text-green-600 font-medium mb-1">Jumlah Rupiah</p>
                      <p id="detail_jumlah_rupiah" class="text-green-700 font-bold text-lg">-</p>
                  </div>
              </div>

              <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                  <p class="text-sm text-gray-600 font-medium mb-1">Keterangan</p>
                  <p id="detail_keterangan" class="text-gray-800 font-semibold">-</p>
              </div>

              <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                  <p class="text-sm text-gray-600 font-medium mb-1">Tanggal Transaksi</p>
                  <p id="detail_tanggal_transaksi" class="text-gray-800 font-semibold">-</p>
              </div>

              <div class="bg-purple-50 p-4 rounded-lg border border-purple-200">
                  <p class="text-sm text-purple-600 font-medium mb-1">Dokumen</p>
                  <div id="detail_dokumen" class="text-gray-800 font-semibold">-</div>
              </div>
          </div>
      </div>

      <!-- Footer -->
  </div>
</div>
<!-- Modal Preview BUBM -->
<div id="bubmImagePreviewModal" class="fixed inset-0 hidden items-center justify-center z-50">
    <!-- Overlay -->
    <div class="absolute inset-0 bg-black bg-opacity-70 glass-effect backdrop-blur-sm" onclick="closeBubmImageModal()"></div>

    <!-- Konten Modal -->
    <div id="bubmModalContent" 
         class="relative bg-white/95 rounded-2xl shadow-2xl max-w-2xl w-full mx-4 p-6 transform transition-all duration-300 scale-95 opacity-0">
        <!-- Tombol Close -->
        <button onclick="closeBubmImageModal()" 
            class="absolute top-4 right-4 bg-gray-100 hover:bg-red-100 w-10 h-10 rounded-full flex items-center justify-center transition-all duration-300 group">
            <i class="fas fa-times text-xl text-gray-600 group-hover:text-red-600"></i>
        </button>
        
        <!-- Header -->
        <div class="text-center mb-4">
            <h3 class="text-xl font-semibold text-gray-800">Preview Dokumen BUBM</h3>
            <p class="text-sm text-gray-500 mt-1">Pastikan dokumen sesuai sebelum digunakan</p>
        </div>
        
        <!-- Gambar -->
        <div class="flex justify-center relative">
            <img id="bubmPreviewImage" src="" alt="Preview Dokumen" class="rounded-xl max-h-[60vh] object-contain shadow-lg">
            
            <!-- Loading indicator -->
            <div id="bubmLoading" class="absolute inset-0 flex items-center justify-center hidden">
                <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-600"></div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="mt-6 flex justify-center space-x-3">
            <a id="bubmDownloadLink" href="#" download 
               class="px-6 py-3 bg-blue-600 text-white rounded-xl shadow hover:bg-blue-700 transition-all duration-300 flex items-center group">
                <i class="fas fa-download mr-2 group-hover:animate-bounce"></i> Download
            </a>
            
            <button onclick="closeBubmImageModal()" 
                class="px-6 py-3 bg-gray-100 text-gray-700 rounded-xl hover:bg-gray-200 transition-all duration-300 flex items-center">
                <i class="fas fa-times mr-2"></i> Tutup
            </button>
        </div>
    </div>
</div>

<!-- Modal Edit BUBM -->
<div id="modalEditBubm" class="fixed inset-0 hidden bg-black bg-opacity-50 flex items-center justify-center z-50">
  <div class="bg-white w-full max-w-2xl rounded-xl shadow-lg p-6 relative">
    
    <!-- Tombol Close -->
    <button type="button" id="closeModalEdit" 
            class="absolute top-3 right-3 text-gray-500 hover:text-gray-700">
      <i class="fas fa-times text-xl"></i>
    </button>

    <h2 class="text-xl font-semibold mb-4 text-bpjs-primary">Edit Data BUBM</h2>

    <form id="formEditBubm" method="post" enctype="multipart/form-data">
        <?= csrf_field() ?>

        <input type="hidden" name="id" id="edit_id">

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Kode Transaksi</label>
                <div class="relative group">
                    <i class="fas fa-barcode absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 group-focus-within:text-bpjs-accent"></i>
                    <input type="text" name="kode_transaksi" id="edit_kode_transaksi" 
                           class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-bpjs-accent/50 text-gray-700 transition bg-gray-50 hover:bg-white" readonly>
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Voucher</label>
                <div class="relative group">
                    <i class="fas fa-ticket-alt absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 group-focus-within:text-bpjs-accent"></i>
                    <input type="text" name="voucher" id="edit_voucher" 
                           class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-bpjs-accent/50 text-gray-700 transition bg-gray-50 hover:bg-white">
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Program</label>
                <div class="relative group">
                    <i class="fas fa-list-alt absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 group-focus-within:text-bpjs-accent"></i>
                    <input type="text" name="program" id="edit_program" 
                           class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-bpjs-accent/50 text-gray-700 transition bg-gray-50 hover:bg-white" readonly>
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Nomor Rak</label>
                <div class="relative group">
                    <i class="fas fa-box absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 group-focus-within:text-bpjs-accent"></i>
                    <input type="text" name="nomor_rak" id="edit_nomor_rak" 
                           class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-bpjs-accent/50 text-gray-700 transition bg-gray-50 hover:bg-white">
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Nomor Baris</label>
                <div class="relative group">
                    <i class="fas fa-th-list absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 group-focus-within:text-bpjs-accent"></i>
                    <input type="text" name="nomor_baris" id="edit_nomor_baris" 
                           class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-bpjs-accent/50 text-gray-700 transition bg-gray-50 hover:bg-white">
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Jumlah Rupiah</label>
                <div class="relative group">
                    <i class="fas fa-money-bill-wave absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 group-focus-within:text-bpjs-accent"></i>
                    <input type="number" name="jumlah_rupiah" id="edit_jumlah_rupiah" 
                           class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-bpjs-accent/50 text-gray-700 transition bg-gray-50 hover:bg-white">
                </div>
            </div>
            <div class="col-span-2">
                <label class="block text-sm font-medium text-gray-700">Keterangan</label>
                <div class="relative group">
                    <i class="fas fa-comment absolute left-3 top-3.5 text-gray-400 group-focus-within:text-bpjs-accent"></i>
                    <textarea name="keterangan" id="edit_keterangan" rows="3" 
                              class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-bpjs-accent/50 text-gray-700 transition bg-gray-50 hover:bg-white"></textarea>
                </div>
            </div>
            <div class="col-span-2">
                <label class="block text-sm font-medium text-gray-700">Dokumen (opsional)</label>
                <div class="relative group">
                    <i class="fas fa-file-upload absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 group-focus-within:text-bpjs-accent"></i>
                    <input type="file" name="dokumen" class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-bpjs-accent/50 text-gray-700 transition bg-gray-50 hover:bg-white">
                    <small class="text-gray-500 mt-1 block">Biarkan kosong jika tidak ingin mengganti dokumen.</small>
                </div>
            </div>
        </div>

        <div class="mt-6 flex justify-end space-x-3">
            <button type="button" id="cancelEdit"
                    class="px-4 py-2 rounded-lg bg-gray-200 hover:bg-gray-300 transition">
                Batal
            </button>
            <button type="submit"
                    class="px-4 py-2 rounded-lg bg-gradient-to-r from-bpjs-accent to-orange-500 text-white font-semibold hover:opacity-90 shadow-lg transition transform hover:scale-105">
                Simpan Perubahan
            </button>
        </div>
    </form>
  </div>
</div>


<style>
    .file-upload:hover {
        border-color: #1c5ca4;
        background-color: #f0f7ff;
    }
    
    table th, table td {
        border-bottom: 1px solid #e5e7eb;
    }
</style>




<script>
document.addEventListener("DOMContentLoaded", () => {
    const modalDetail = document.getElementById("modalDetailBubm");
    const closeModalDetail = document.getElementById("closeModalDetailBubm");

    // Fungsi untuk menampilkan detail BUBM
    function showDetailBubm(data) {
        document.getElementById("detail_kode_transaksi").textContent = data.kode_transaksi || '-';
        document.getElementById("detail_voucher").textContent = data.voucher || '-';
        document.getElementById("detail_program").textContent = data.program || '-';
        document.getElementById("detail_nomor_rak").textContent = data.nomor_rak || '-';
        document.getElementById("detail_nomor_baris").textContent = data.nomor_baris || '-';
        document.getElementById("detail_jumlah_rupiah").textContent = data.jumlah_rupiah ? 'Rp ' + data.jumlah_rupiah : '-';
        document.getElementById("detail_keterangan").textContent = data.keterangan || '-';
        document.getElementById("detail_tanggal_transaksi").textContent = data.tanggal_transaksi || '-';

        const dokumenLink = document.getElementById("detail_dokumen");
        if (data.dokumen) {
            dokumenLink.innerHTML = `<a href="${data.dokumen}" target="_blank" class="text-blue-600 hover:underline">Lihat Dokumen</a>`;
        } else {
            dokumenLink.textContent = '-';
        }

        modalDetail.classList.remove("hidden");
        modalDetail.querySelector(".scale-95").classList.remove("scale-95");
    }

    // Event listener untuk tombol detail
    document.querySelectorAll(".btn-detail-bubm").forEach(button => {
        button.addEventListener("click", function() {
            const data = {
                id: this.dataset.id,
                kode_transaksi: this.dataset.kode_transaksi,
                voucher: this.dataset.voucher,
                program: this.dataset.program,
                nomor_rak: this.dataset.nomor_rak,
                nomor_baris: this.dataset.nomor_baris,
                jumlah_rupiah: this.dataset.jumlah_rupiah,
                keterangan: this.dataset.keterangan,
                dokumen: this.dataset.dokumen,
                tanggal_transaksi: this.dataset.tanggal_transaksi
            };
            showDetailBubm(data);
        });
    });

    // Tutup modal detail
    closeModalDetail.addEventListener("click", () => {
        modalDetail.classList.add("hidden");
        modalDetail.querySelector(".transform").classList.add("scale-95");
    });

    // Script untuk modal edit (tetap dipertahankan)
    const modalEdit = document.getElementById("modalEditBubm");
    const closeModalEdit = document.getElementById("closeModalEdit");
    const cancelEdit = document.getElementById("cancelEdit");
    const formEdit = document.getElementById("formEditBubm");

    // Klik tombol Edit
    document.querySelectorAll(".btn-edit-bubm").forEach(btn => {
        btn.addEventListener("click", () => {
            // Isi form dari atribut data-*
            document.getElementById("edit_id").value = btn.dataset.id;
            document.getElementById("edit_kode_transaksi").value = btn.dataset.kode_transaksi;
            document.getElementById("edit_voucher").value = btn.dataset.voucher;
            document.getElementById("edit_program").value = btn.dataset.program;
            document.getElementById("edit_nomor_rak").value = btn.dataset.nomor_rak;
            document.getElementById("edit_nomor_baris").value = btn.dataset.nomor_baris;
            document.getElementById("edit_jumlah_rupiah").value = btn.dataset.jumlah_rupiah;
            document.getElementById("edit_keterangan").value = btn.dataset.keterangan;

            // Set action form
            formEdit.action = "<?= base_url('admin/bubm/update/') ?>" + btn.dataset.id;

            // Tampilkan modal
            modalEdit.classList.remove("hidden");
        });
    });

    // Tutup modal edit
    [closeModalEdit, cancelEdit].forEach(el => {
        el.addEventListener("click", () => modalEdit.classList.add("hidden"));
    });
});
</script>



<script>
    document.addEventListener("DOMContentLoaded", () => {
        const modal = document.getElementById("modalEditBubm");
        const closeModal = document.getElementById("closeModalEdit");
        const cancelEdit = document.getElementById("cancelEdit");
        const formEdit = document.getElementById("formEditBubm");

        // Klik tombol Edit
        document.querySelectorAll(".btn-edit-bubm").forEach(btn => {
            btn.addEventListener("click", () => {
                // Isi form dari atribut data-*
                document.getElementById("edit_id").value = btn.dataset.id;
                document.getElementById("edit_kode_transaksi").value = btn.dataset.kode_transaksi;
                document.getElementById("edit_voucher").value = btn.dataset.voucher;
                document.getElementById("edit_program").value = btn.dataset.program;
                document.getElementById("edit_nomor_rak").value = btn.dataset.nomor_rak;
                document.getElementById("edit_nomor_baris").value = btn.dataset.nomor_baris;
                document.getElementById("edit_jumlah_rupiah").value = btn.dataset.jumlah_rupiah;
                document.getElementById("edit_keterangan").value = btn.dataset.keterangan;

                // Set action form
                formEdit.action = "<?= base_url('admin/bubm/update/') ?>" + btn.dataset.id;

                // Tampilkan modal
                modal.classList.remove("hidden");
            });
        });

        // Tutup modal
        [closeModal, cancelEdit].forEach(el => {
            el.addEventListener("click", () => modal.classList.add("hidden"));
        });
    });
</script>

<script>
    // Ambil elemen
    const modalBubm = document.getElementById('modalDetailBubm');
    const closeModalBubm = document.getElementById('closeModalDetailBubm');

    // Fungsi untuk menampilkan detail BUBM
    function showDetailBubm(data) {
        document.getElementById('detail_kode_transaksi').textContent = data.kode_transaksi || '-';
        document.getElementById('detail_voucher').textContent = data.voucher || '-';
        document.getElementById('detail_tanggal_transaksi').textContent = data.tanggal_transaksi || '-';
        document.getElementById('detail_program').textContent = data.program || '-';
        document.getElementById('detail_nomor_rak').textContent = data.nomor_rak || '-';
        document.getElementById('detail_nomor_baris').textContent = data.nomor_baris || '-';
        document.getElementById('detail_jumlah_rupiah').textContent = data.jumlah_rupiah ? 'Rp ' + data.jumlah_rupiah : '-';
        document.getElementById('detail_keterangan').textContent = data.keterangan || '-';

        const dokumenLink = document.getElementById('detail_dokumen');
        if (data.dokumen) {
            dokumenLink.innerHTML = `<a href="${data.dokumen}" target="_blank" class="text-blue-600 hover:underline">Lihat Dokumen</a>`;
        } else {
            dokumenLink.textContent = '-';
        }

        modalBubm.classList.remove('hidden');
        modalBubm.querySelector('.scale-95').classList.remove('scale-95');
    }

    // Tutup modal
    closeModalBubm.addEventListener('click', () => {
        modalBubm.classList.add('hidden');
        modalBubm.querySelector('.transform').classList.add('scale-95');
    });

    // File upload handling
    document.addEventListener('DOMContentLoaded', function() {
        const fileInput = document.getElementById('file_excel');
        const fileUploadArea = document.querySelector('.file-upload');
        const fileName = document.getElementById('fileName');

        // Klik area untuk buka input file
        fileUploadArea.addEventListener('click', function() {
            fileInput.click();
        });

        fileInput.addEventListener('change', function() {
            if (this.files.length > 0) {
                const selectedFile = this.files[0].name;
                fileName.textContent = 'File terpilih: ' + selectedFile;
                fileName.classList.remove('hidden');

                // Tambahkan style hijau untuk indikasi sukses
                fileUploadArea.classList.add('border-green-400', 'bg-green-50');

                const statusArea = document.getElementById('fileStatus');
                if (statusArea) {
                    statusArea.innerHTML = `
                        <i class="fas fa-check-circle text-2xl text-green-500 mb-2"></i>
                        <p class="text-sm text-green-600 mb-1">File berhasil dipilih</p>
                        <p class="text-xs text-green-500">${selectedFile}</p>
                    `;
                }
            }
        });

        // Event listener untuk tombol detail
        document.querySelectorAll('.btn-detail-bubm').forEach(button => {
            button.addEventListener('click', function() {
                const data = {
                    id: this.dataset.id,
                    kode_transaksi: this.dataset.kode_transaksi,
                    voucher: this.dataset.voucher,
                    program: this.dataset.program,
                    nomor_rak: this.dataset.nomor_rak,
                    nomor_baris: this.dataset.nomor_baris,
                    jumlah_rupiah: this.dataset.jumlah_rupiah,
                    keterangan: this.dataset.keterangan,
                    dokumen: this.dataset.dokumen,
                    tanggal_transaksi: this.dataset.tanggal_transaksi
                };
                showDetailBubm(data);
            });
        });
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

<style>
.glass-effect {
    backdrop-filter: blur(8px);
    -webkit-backdrop-filter: blur(8px);
}

#bubmImagePreviewModal.active {
    display: flex;
    animation: fadeIn 0.3s ease-out;
}

#bubmImagePreviewModal.active #bubmModalContent {
    animation: slideUp 0.4s ease-out forwards;
}

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

@keyframes slideUp {
    from { 
        transform: translateY(20px) scale(0.95);
        opacity: 0;
    }
    to { 
        transform: translateY(0) scale(1);
        opacity: 1;
    }
}
</style>

<script>
function showBubmImageModal(imageSrc, fileName) {
    const modal = document.getElementById('bubmImagePreviewModal');
    const modalImage = document.getElementById('bubmPreviewImage');
    const downloadLink = document.getElementById('bubmDownloadLink');
    const loading = document.getElementById('bubmLoading');
    
    // Tampilkan loading
    loading.classList.remove('hidden');
    
    // Set gambar
    modalImage.onload = function() {
        loading.classList.add('hidden');
    };
    
    modalImage.src = imageSrc;
    downloadLink.href = imageSrc;
    if (fileName) downloadLink.setAttribute("download", fileName);
    
    // Tampilkan modal
    modal.classList.remove('hidden');
    setTimeout(() => modal.classList.add('active'), 10);
}

function closeBubmImageModal() {
    const modal = document.getElementById('bubmImagePreviewModal');
    modal.classList.remove('active');
    setTimeout(() => modal.classList.add('hidden'), 300);
}
</script>
<?= $this->endSection() ?>
