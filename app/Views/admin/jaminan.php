<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="p-6">
    <!-- Header -->
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-bpjs-primary flex items-center gap-2">
            <i data-lucide="file-plus" class="w-6 h-6 text-bpjs-accent"></i>
            Input Jaminan Baru
        </h1>
        <a href="/admin/dashboard" class="flex items-center gap-2 text-sm px-4 py-2 rounded-lg bg-gray-100 hover:bg-gray-200 text-gray-700 transition">
            <i data-lucide="arrow-left" class="w-4 h-4"></i>
            Kembali
        </a>
    </div>

    <!-- Card Form -->
    <div class="bg-white rounded-2xl shadow-lg p-8 border border-gray-200">
        <form action="/admin/jaminan/store" method="post" class="space-y-6">
            <!-- Nama Peserta -->
            <div>
                <label for="nama" class="block text-sm font-medium text-gray-700 mb-2">
                    Nama Peserta
                </label>
                <div class="relative">
                    <i data-lucide="user" class="absolute left-3 top-3.5 w-5 h-5 text-gray-400"></i>
                    <input type="text" id="nama" name="nama" placeholder="Masukkan nama peserta"
                        class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-bpjs-accent/50 focus:border-bpjs-accent text-gray-700">
                </div>
            </div>

            <!-- Nomor Kartu -->
            <div>
                <label for="nomor_kartu" class="block text-sm font-medium text-gray-700 mb-2">
                    Nomor Kartu BPJS
                </label>
                <div class="relative">
                    <i data-lucide="credit-card" class="absolute left-3 top-3.5 w-5 h-5 text-gray-400"></i>
                    <input type="text" id="nomor_kartu" name="nomor_kartu" placeholder="Masukkan nomor kartu"
                        class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-bpjs-accent/50 focus:border-bpjs-accent text-gray-700">
                </div>
            </div>

            <!-- Jenis Jaminan -->
            <div>
                <label for="jenis_jaminan" class="block text-sm font-medium text-gray-700 mb-2">
                    Jenis Jaminan
                </label>
                <div class="relative">
                    <i data-lucide="layers" class="absolute left-3 top-3.5 w-5 h-5 text-gray-400"></i>
                    <select id="jenis_jaminan" name="jenis_jaminan"
                        class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-bpjs-accent/50 focus:border-bpjs-accent text-gray-700">
                        <option value="">-- Pilih Jenis Jaminan --</option>
                        <option value="Kesehatan">Jaminan Kesehatan</option>
                        <option value="Kecelakaan">Jaminan Kecelakaan</option>
                        <option value="Hari Tua">Jaminan Hari Tua</option>
                        <option value="Pensiun">Jaminan Pensiun</option>
                    </select>
                </div>
            </div>

            <!-- Tanggal Mulai -->
            <div>
                <label for="tgl_mulai" class="block text-sm font-medium text-gray-700 mb-2">
                    Tanggal Mulai
                </label>
                <div class="relative">
                    <i data-lucide="calendar" class="absolute left-3 top-3.5 w-5 h-5 text-gray-400"></i>
                    <input type="date" id="tgl_mulai" name="tgl_mulai"
                        class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-bpjs-accent/50 focus:border-bpjs-accent text-gray-700">
                </div>
            </div>

            <!-- Keterangan -->
            <div>
                <label for="keterangan" class="block text-sm font-medium text-gray-700 mb-2">
                    Keterangan
                </label>
                <div class="relative">
                    <i data-lucide="file-text" class="absolute left-3 top-3.5 w-5 h-5 text-gray-400"></i>
                    <textarea id="keterangan" name="keterangan" rows="3" placeholder="Tambahkan keterangan"
                        class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-bpjs-accent/50 focus:border-bpjs-accent text-gray-700"></textarea>
                </div>
            </div>

            <!-- Submit -->
            <div class="flex justify-end">
                <button type="submit"
                    class="flex items-center gap-2 px-6 py-3 rounded-xl bg-gradient-to-r from-bpjs-accent to-orange-500 text-white font-semibold hover:opacity-90 shadow-lg transition">
                    <i data-lucide="save" class="w-5 h-5"></i>
                    Simpan Data
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Lucide Icons -->
<script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>
<script>
    lucide.createIcons();
</script>
<?= $this->endSection() ?>
