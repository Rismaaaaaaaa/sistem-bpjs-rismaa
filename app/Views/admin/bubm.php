<?= $this->extend('layouts/main') ?>


<?= $this->section('content') ?>

<div class="p-6">
    <h1 class="text-2xl font-semibold mb-6"><?= $title ?></h1>

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

        <!-- Total Rupiah -->
        <div class="bg-white rounded-2xl shadow-sm p-4 border border-gray-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Total Rupiah</p>
                    <h3 class="text-2xl font-bold text-gray-800">
                        Rp <?= number_format($totalRupiah, 2, ',', '.') ?>
                    </h3>
                </div>
                <div class="p-3 rounded-lg bg-green-100">
                    <i class="fas fa-money-bill-wave text-green-600 text-xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Tombol Tambah Data -->
    <div class="mb-4">
        <a href="<?= site_url('admin/bubm/create') ?>" class="flex items-center gap-2 px-4 py-2.5 rounded-xl bg-gradient-to-r from-bpjs-accent to-orange-500 text-white font-semibold hover:opacity-90 shadow-lg transition">
            <i class="fas fa-plus"></i>
            Tambah Data
        </a>
    </div>

    <!-- Tabel Data -->
    <div class="overflow-x-auto bg-white rounded-2xl shadow-sm border border-gray-200">
        <table class="w-full">
            <thead class="bg-gradient-to-r from-bpjs-primary to-bpjs-darkblue text-white">
                <tr>
                    <th class="p-4 text-left font-semibold">#</th>
                    <th class="p-4 text-left font-semibold">Kode Transaksi</th>
                    <th class="p-4 text-left font-semibold">Voucher</th>
                    <th class="p-4 text-left font-semibold">Program</th>
                    <th class="p-4 text-left font-semibold">Jumlah Rupiah</th>
                    <th class="p-4 text-left font-semibold">Keterangan</th>
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
                            <td class="p-4"><?= esc($row['voucher']) ?></td>
                            <td class="p-4"><?= esc($row['program']) ?></td>
                            <td class="p-4">
                                <span class="px-3 py-1 rounded-full bg-green-100 text-green-800 text-sm font-medium">
                                    Rp <?= number_format($row['jumlah_rupiah'], 2, ',', '.') ?>
                                </span>
                            </td>
                            <td class="p-4"><?= esc($row['keterangan']) ?></td>
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
                                    <!-- Edit -->
                                    <a href="<?= site_url('admin/bubm/edit/'.$row['id']) ?>" class="p-2 rounded-lg bg-blue-100 text-blue-600 hover:bg-blue-200 transition" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <!-- Hapus -->
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

<?= $this->endSection() ?>
