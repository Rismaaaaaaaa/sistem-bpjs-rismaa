<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 mt-14">
    <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100">
        <!-- Header -->
        <div class="px-6 py-5 bg-gradient-to-r from-blue-50 to-indigo-50 border-b border-gray-200">
            <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">Manajemen Pengguna</h2>
                    <p class="text-sm text-gray-600 mt-1">Kelola semua pengguna sistem dengan mudah</p>
                </div>
                <a href="<?= site_url('admin/tambah_user') ?>" class="flex items-center px-5 py-2.5 bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded-xl shadow-md hover:from-blue-700 hover:to-indigo-700 transition-all duration-300 hover:shadow-lg">
                    <i class="fas fa-plus-circle mr-2"></i> Tambah User Baru
                </a>
            </div>
        </div>

        <!-- Alert Notification -->
        <?php if (session()->getFlashdata('success')): ?>
            <div class="m-6 mb-0 p-4 bg-green-50 border-l-4 border-green-500 rounded-lg shadow-sm">
                <div class="flex items-center">
                    <i class="fas fa-check-circle text-green-500 mr-3"></i>
                    <p class="text-green-700 font-medium"><?= session()->getFlashdata('success') ?></p>
                </div>
            </div>
        <?php endif; ?>

        <!-- Table Container -->
        <div class="px-6 py-5">
            <div class="relative overflow-x-auto rounded-lg border border-gray-200 shadow-sm">
                <table class="w-full text-sm text-left text-gray-700">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50/80 backdrop-blur-sm">
                        <tr>
                            <th scope="col" class="px-6 py-4 font-medium">#</th>
                            <th scope="col" class="px-6 py-4 font-medium">Username</th>
                            <th scope="col" class="px-6 py-4 font-medium">Email</th>
                            <th scope="col" class="px-6 py-4 font-medium">Role</th>
                            <th scope="col" class="px-6 py-4 font-medium">No HP</th>
                            <th scope="col" class="px-6 py-4 font-medium">Jenis Kelamin</th>
                            <th scope="col" class="px-6 py-4 font-medium">Tanggal Lahir</th>
                            <th scope="col" class="px-6 py-4 font-medium text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <?php if (!empty($users)): ?>
                            <?php foreach ($users as $i => $user): ?>
                                <tr class="bg-white hover:bg-gray-50/50 transition-colors duration-150">
                                    <td class="px-6 py-4 whitespace-nowrap"><?= $i + 1 ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900">
                                        <?= esc($user['username']) ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap"><?= esc($user['email']) ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                            <?= $user['role'] === 'superadmin' ? 'bg-red-100 text-red-800' : 'bg-blue-100 text-blue-800' ?>">
                                            <?= esc($user['role']) ?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap"><?= esc($user['no_hp']) ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap"><?= esc($user['jenis_kelamin']) ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap"><?= esc($user['tanggal_lahir']) ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right">
                                        <div class="flex items-center justify-end space-x-2">
                                            <a href="<?= site_url('admin/users/edit/'.$user['id']) ?>" class="inline-flex items-center p-2 text-sm font-medium text-center text-blue-600 bg-blue-50 rounded-lg hover:bg-blue-100 transition-colors duration-200" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="<?= site_url('admin/users/delete/'.$user['id']) ?>" onclick="return confirm('Yakin mau hapus user ini?')" class="inline-flex items-center p-2 text-sm font-medium text-center text-red-600 bg-red-50 rounded-lg hover:bg-red-100 transition-colors duration-200" title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="8" class="px-6 py-8 text-center">
                                    <div class="flex flex-col items-center justify-center text-gray-400 py-4">
                                        <i class="fas fa-users text-4xl mb-3 opacity-30"></i>
                                        <p class="text-lg font-medium">Belum ada data user</p>
                                        <p class="text-sm mt-1">Mulai dengan menambahkan user baru</p>
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
        
        <!-- Optional: Pagination or footer -->
        <?php if (!empty($users)): ?>
        <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
            <div class="flex items-center justify-between">
                <p class="text-sm text-gray-700">Menampilkan <span class="font-medium"><?= count($users) ?></span> user</p>
                <!-- Pagination can be added here -->
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>

<?= $this->endSection() ?>