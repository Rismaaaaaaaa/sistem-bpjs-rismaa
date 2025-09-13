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
            <p class="text-gray-600 mt-2 ml-11">Kelola data Bantuan Uang Muka Biaya Medis (BUBM) BPJS Kesehatan</p>
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
                    href="<?= site_url('admin/bubm/export') ?>" 
                    class="w-full md:w-auto px-4 py-3 bg-green-600 text-white rounded-xl hover:bg-green-700 transition font-medium flex items-center gap-2"
                >
                    <i class="fas fa-file-export"></i> Export
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
                                <td class="p-4 font-medium text-bpjs-primary"><?= esc($row['kode_transaksi']) ?> - <?= esc($row['voucher']) ?></td>
                                <td class="p-4">
                                    <div class="flex items-center">
                                        <div class="p-2 rounded-lg bg-indigo-100 mr-2">
                                            <i class="fas fa-list-alt text-indigo-600"></i>
                                        </div>
                                        <?= esc($row['program']) ?>
                                    </div>
                                </td>
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
                                        <!-- Tombol Detail -->
                                      <!-- Tombol Detail BUBM -->
                                        <button 
                                            type="button"
                                            class="p-2 rounded-lg bg-blue-100 text-blue-600 hover:bg-blue-200 transition btn-detail-bubm"
                                            data-id="<?= $row['id'] ?>"
                                            data-kode_transaksi="<?= esc($row['kode_transaksi']) ?>"
                                            data-voucher="<?= esc($row['voucher']) ?>"
                                            data-program="<?= esc($row['program']) ?>"
                                            data-jumlah_rupiah="<?= esc(number_format($row['jumlah_rupiah'], 0, ',', '.')) ?>"
                                            data-keterangan="<?= esc($row['keterangan']) ?>"
                                            data-dokumen="<?= esc($row['dokumen']) ?>"
                                            data-tanggal_transaksi="<?= esc($row['tanggal_transaksi']) ?>"
                                            title="Lihat Detail"
                                        >
                                            <i class="fas fa-eye"></i>
                                        </button>


                                        <!-- Tombol Edit -->
                                        <button 
                                            class="p-2 rounded-lg bg-blue-100 text-blue-600 hover:bg-blue-200 transition btn-edit-bubm"
                                            data-id="<?= $row['id'] ?>"
                                            data-kode_transaksi="<?= esc($row['kode_transaksi']) ?>"
                                            data-voucher="<?= esc($row['voucher']) ?>"
                                            data-program="<?= esc($row['program']) ?>"
                                            data-jumlah_rupiah="<?= esc($row['jumlah_rupiah']) ?>"
                                            data-keterangan="<?= esc($row['keterangan']) ?>"
                                            data-dokumen="<?= esc($row['dokumen']) ?>"
                                            data-tanggal_transaksi="<?= esc($row['tanggal_transaksi']) ?>"
                                            title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </button>

                                        <!-- Tombol Hapus -->
                                        <form action="<?= base_url('admin/bubm/delete/'.$row['id']) ?>" method="post" onsubmit="return confirm('Yakin mau hapus data ini?')" class="inline">
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
                            <td colspan="8" class="p-8 text-center">
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
<div id="modalDetailBubm" class="fixed inset-0 hidden bg-black bg-opacity-50 flex items-center justify-center z-50">
  <div class="bg-white w-full max-w-2xl rounded-xl shadow-lg p-6 relative">
    
    <!-- Tombol Close -->
    <button type="button" id="closeModalDetail" 
            class="absolute top-3 right-3 text-gray-500 hover:text-gray-700">
      <i class="fas fa-times text-xl"></i>
    </button>

    <h2 class="text-xl font-semibold mb-4 text-bpjs-primary">Detail Data BUBM</h2>

    <div class="grid grid-cols-2 gap-4 text-sm">
        <div>
            <p class="font-medium text-gray-600">Kode Transaksi</p>
            <p id="detail_kode_transaksi" class="text-gray-800"></p>
        </div>
        <div>
            <p class="font-medium text-gray-600">Voucher</p>
            <p id="detail_voucher" class="text-gray-800"></p>
        </div>
        <div>
            <p class="font-medium text-gray-600">Program</p>
            <p id="detail_program" class="text-gray-800"></p>
        </div>
        <div>
            <p class="font-medium text-gray-600">Jumlah Rupiah</p>
            <p id="detail_jumlah_rupiah" class="text-green-600 font-semibold"></p>
        </div>
        <div class="col-span-2">
            <p class="font-medium text-gray-600">Keterangan</p>
            <p id="detail_keterangan" class="text-gray-800"></p>
        </div>
        <div class="col-span-2">
            <p class="font-medium text-gray-600">Tanggal Transaksi</p>
            <p id="detail_tanggal_transaksi" class="text-gray-800"></p>
        </div>
        <div class="col-span-2">
            <p class="font-medium text-gray-600">Dokumen</p>
            <div id="detail_dokumen"></div>
        </div>
    </div>

    <div class="mt-6 flex justify-end">
        <button type="button" id="closeDetailBtn"
                class="px-4 py-2 rounded-lg bg-gray-200 hover:bg-gray-300 transition">
            Tutup
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
                <label class="block text-sm font-medium">Kode Transaksi</label>
                <input type="text" name="kode_transaksi" id="edit_kode_transaksi" 
                       class="w-full border rounded-lg p-2 mt-1" readonly>
            </div>
            <div>
                <label class="block text-sm font-medium">Voucher</label>
                <input type="text" name="voucher" id="edit_voucher" 
                       class="w-full border rounded-lg p-2 mt-1">
            </div>
            <div>
                <label class="block text-sm font-medium">Program</label>
                <input type="text" name="program" id="edit_program" 
                       class="w-full border rounded-lg p-2 mt-1" readonly>
            </div>
            <div>
                <label class="block text-sm font-medium">Jumlah Rupiah</label>
                <input type="number" name="jumlah_rupiah" id="edit_jumlah_rupiah" 
                       class="w-full border rounded-lg p-2 mt-1">
            </div>
            <div class="col-span-2">
                <label class="block text-sm font-medium">Keterangan</label>
                <textarea name="keterangan" id="edit_keterangan" rows="3" 
                          class="w-full border rounded-lg p-2 mt-1"></textarea>
            </div>
            <div class="col-span-2">
                <label class="block text-sm font-medium">Dokumen (opsional)</label>
                <input type="file" name="dokumen" class="w-full border rounded-lg p-2 mt-1">
                <small class="text-gray-500">Biarkan kosong jika tidak ingin mengganti dokumen.</small>
            </div>
        </div>

        <div class="mt-6 flex justify-end space-x-3">
            <button type="button" id="cancelEdit"
                    class="px-4 py-2 rounded-lg bg-gray-200 hover:bg-gray-300 transition">
                Batal
            </button>
            <button type="submit"
                    class="px-4 py-2 rounded-lg bg-bpjs-primary text-white hover:bg-bpjs-darkblue transition">
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
    const closeDetail = document.getElementById("closeModalDetail");
    const closeDetailBtn = document.getElementById("closeDetailBtn");

    document.querySelectorAll(".btn-detail-bubm").forEach(btn => {
        btn.addEventListener("click", () => {
            document.getElementById("detail_kode_transaksi").innerText = btn.dataset.kode_transaksi;
            document.getElementById("detail_voucher").innerText = btn.dataset.voucher;
            document.getElementById("detail_program").innerText = btn.dataset.program;
            document.getElementById("detail_jumlah_rupiah").innerText = "Rp " + btn.dataset.jumlah_rupiah;
            document.getElementById("detail_keterangan").innerText = btn.dataset.keterangan || "-";
            document.getElementById("detail_tanggal_transaksi").innerText = btn.dataset.tanggal_transaksi;

            // Dokumen
            if (btn.dataset.dokumen) {
                document.getElementById("detail_dokumen").innerHTML = `
                    <a href="<?= base_url('uploads/bubm/') ?>${btn.dataset.dokumen}" 
                       target="_blank" 
                       class="inline-flex items-center px-3 py-2 rounded-lg bg-blue-100 text-blue-700 hover:bg-blue-200 transition">
                        <i class="fas fa-file-pdf mr-2"></i> Lihat Dokumen
                    </a>`;
            } else {
                document.getElementById("detail_dokumen").innerHTML = `
                    <span class="inline-flex items-center px-3 py-2 rounded-lg bg-gray-100 text-gray-600">
                        <i class="fas fa-times-circle mr-2"></i> Tidak ada dokumen
                    </span>`;
            }

            modalDetail.classList.remove("hidden");
        });
    });

    // Tutup modal
    [closeDetail, closeDetailBtn].forEach(el => {
        el.addEventListener("click", () => modalDetail.classList.add("hidden"));
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
// ambil elemen
const modalBubm = document.getElementById('modalDetailBubm');
const closeModalBubm = document.getElementById('closeModalDetailBubm');

function showDetailBubm(data) {
    document.getElementById('detailBubmKode').textContent = data.kode_transaksi || '-';
    document.getElementById('detailBubmVoucher').textContent = data.voucher || '-';
    document.getElementById('detailBubmTanggal').textContent = data.tanggal_transaksi || '-';
    document.getElementById('detailBubmProgram').textContent = data.program || '-';
    document.getElementById('detailBubmJumlah').textContent = data.jumlah_rupiah ? 'Rp ' + data.jumlah_rupiah : '-';
    document.getElementById('detailBubmKeterangan').textContent = data.keterangan || '-';

    const dokumenLink = document.getElementById('detailBubmDokumen');
    if (data.dokumen) {
        dokumenLink.href = data.dokumen;
        dokumenLink.textContent = "Lihat Dokumen";
    } else {
        dokumenLink.removeAttribute('href');
        dokumenLink.textContent = "-";
    }

    document.getElementById('modalDetailBubm').classList.remove('hidden');
}

// Tutup modal
document.getElementById('closeModalDetailBubm').addEventListener('click', () => {
    document.getElementById('modalDetailBubm').classList.add('hidden');
});




    document.addEventListener('DOMContentLoaded', function() {
        const fileInput = document.getElementById('file_excel');
        const fileUploadArea = document.querySelector('.file-upload');
        const fileName = document.getElementById('fileName');

        // klik area untuk buka input file
        fileUploadArea.addEventListener('click', function() {
            fileInput.click();
        });

        fileInput.addEventListener('change', function() {
            if (this.files.length > 0) {
                const selectedFile = this.files[0].name;
                fileName.textContent = 'File terpilih: ' + selectedFile;
                fileName.classList.remove('hidden');

                // Tambahin style hijau biar keliatan sukses
                fileUploadArea.classList.add('border-green-400', 'bg-green-50');

                // Jangan replace seluruh innerHTML!  
                // Cukup update teks/ikon di area fileName
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
    });

    // Modal detail
    function openBubmDetail(data) {
        console.log('BUBM Detail:', data);
        alert('Detail fitur akan diimplementasikan di sini untuk: ' + data.kode_transaksi);
    }
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


<?= $this->endSection() ?>
