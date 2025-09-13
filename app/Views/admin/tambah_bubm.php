<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="bg-white rounded-2xl shadow-lg border border-gray-200 p-6">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-bpjs-primary flex items-center gap-3">
            <div class="p-2 rounded-lg bg-bpjs-accent/10">
                <i class="fas fa-plus text-bpjs-accent text-xl"></i>
            </div>
            Tambah Data BUBM
        </h1>
        <a href="<?= site_url('admin/bubm') ?>" 
           class="px-4 py-2.5 rounded-xl border border-gray-300 text-gray-700 font-medium hover:bg-gray-50 transition flex items-center gap-2">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <!-- Form Tambah -->
    <form action="<?= site_url('admin/bubm/store') ?>" method="post" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <?= csrf_field() ?>

        <!-- Voucher -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Nomor Voucher</label>
            <input type="text" name="voucher" 
                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-bpjs-accent/50 transition"
                   placeholder="Masukkan nomor voucher, contoh: RB018 01" required>
            <p class="text-xs text-gray-500 mt-1">Kode transaksi otomatis: <?= date('d/m/Y') ?> - [Nomor Voucher]</p>
        </div>

        <!-- Program -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Program</label>
            <select name="program" id="programSelect"
                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-bpjs-accent/50 transition">
                <option value="BUBM" selected>BUBM</option>
                <option value="lainnya">Lainnya...</option>
            </select>
            <input type="text" name="program_custom" id="programCustom" 
                   class="w-full mt-3 hidden px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-bpjs-accent/50 transition"
                   placeholder="Masukkan nama program lain">
        </div>

        <!-- Jumlah Rupiah -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Jumlah Rupiah</label>
            <input type="number" name="jumlah_rupiah" step="0.01"
                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-bpjs-accent/50 transition"
                   placeholder="Masukkan jumlah (Rp)" required>
        </div>

        <!-- Tanggal Hari Ini (readonly) -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Input</label>
            <input type="text" value="<?= date('d-m-Y') ?>" 
                   class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-gray-100 text-gray-500" readonly>
        </div>

        <!-- Keterangan -->
        <div class="md:col-span-2">
            <label class="block text-sm font-medium text-gray-700 mb-2">Keterangan</label>
            <textarea name="keterangan" rows="3"
                      class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-bpjs-accent/50 transition"
                      placeholder="Tambahkan keterangan transaksi (opsional)"></textarea>
        </div>

        <!-- Upload Dokumen -->
        <div class="md:col-span-2">
            <label class="block text-sm font-medium text-gray-700 mb-2">Upload Dokumen (PNG/JPG/PDF)</label>
            <input type="file" name="dokumen" accept=".jpg,.jpeg,.png,.pdf"
                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-bpjs-accent/50 transition file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
        </div>

        <!-- Tombol Aksi -->
        <div class="md:col-span-2 flex justify-end gap-4 pt-6 border-t border-gray-200 mt-4">
            <button type="reset" 
                    class="px-6 py-3 rounded-xl border border-gray-300 text-gray-700 font-medium hover:bg-gray-50 transition flex items-center gap-2">
                <i class="fas fa-redo"></i> Reset
            </button>
            <button type="submit" 
                    class="flex items-center gap-2 px-6 py-3 rounded-xl bg-gradient-to-r from-bpjs-accent to-orange-500 text-white font-semibold hover:opacity-90 shadow-lg transition transform hover:scale-105">
                <i class="fas fa-save"></i> Simpan Data
            </button>
        </div>
    </form>
</div>

<script>
    document.getElementById('programSelect').addEventListener('change', function () {
        let customInput = document.getElementById('programCustom');
        if (this.value === 'lainnya') {
            customInput.classList.remove('hidden');
            customInput.required = true;
        } else {
            customInput.classList.add('hidden');
            customInput.required = false;
        }
    });
</script>

<?= $this->endSection() ?>
