<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="p-6 min-h-screen flex flex-col items-center">
    <!-- Header -->
    <div class="flex items-center justify-between mb-8 w-full ">
        <div>
            <h1 class="text-2xl font-bold text-bpjs-primary flex items-center gap-3">
                <div class="p-2 rounded-lg bg-bpjs-accent/10">
                    <i class="fas fa-user-cog text-bpjs-accent text-xl"></i>
                </div>
                Pengaturan Akun
            </h1>
            <p class="text-gray-600 mt-2 ml-11">
                Kelola informasi dan preferensi akun Anda
            </p>
        </div>
        <a href="<?= site_url('admin/dashboard') ?>" 
           class="flex items-center gap-2 px-4 py-2.5 rounded-xl border border-gray-300 text-gray-700 font-medium hover:bg-gray-50 transition">
            <i class="fas fa-arrow-left"></i> Kembali ke Dashboard
        </a>
    </div>

    <!-- Main Content (centered) -->
    <div class="w-full ">
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-200">
            <!-- Form Header -->
            <div class="bg-gradient-to-r from-bpjs-primary to-bpjs-darkblue text-white p-5">
                <div class="flex items-center gap-3">
                    <i class="fas fa-user-edit text-bpjs-accent text-xl"></i>
                    <h2 class="text-xl font-semibold">Informasi Profil</h2>
                </div>
                <p class="text-blue-100 mt-2 ml-8">
                    Perbarui informasi profil dan alamat email akun Anda
                </p>
            </div>

            <!-- Notifications -->
            <div class="p-5">
                <?php if(session()->getFlashdata('success')): ?>
                    <div class="p-4 mb-4 bg-green-50 border-l-4 border-green-500 rounded-r">
                        <div class="flex items-center">
                            <i class="fas fa-check-circle text-green-500 text-lg mr-3"></i>
                            <div>
                                <p class="text-green-700 font-medium">Berhasil!</p>
                                <p class="text-green-600 text-sm"><?= session()->getFlashdata('success') ?></p>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if(session()->getFlashdata('errors')): ?>
                    <div class="p-4 mb-4 bg-red-50 border-l-4 border-red-500 rounded-r">
                        <div class="flex items-center">
                            <i class="fas fa-exclamation-circle text-red-500 text-lg mr-3"></i>
                            <div>
                                <p class="text-red-700 font-medium">Terjadi Kesalahan:</p>
                                <ul class="text-red-600 text-sm list-disc list-inside mt-1">
                                    <?php foreach(session()->getFlashdata('errors') as $error): ?>
                                        <li><?= esc($error) ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Form Content -->
            <form action="<?= site_url('admin/settings/update') ?>" method="post" class="p-5 space-y-6">
                <?= csrf_field() ?>

                <!-- Username & Email -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-user text-bpjs-primary mr-1"></i>
                            Username <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <i class="fas fa-user absolute left-3 top-3.5 text-gray-400"></i>
                            <input type="text" name="username" value="<?= esc(old('username', $user['username'] ?? '')) ?>"
                                class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-bpjs-accent/50 text-gray-700 transition"
                                required>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-envelope text-bpjs-primary mr-1"></i>
                            Email <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <i class="fas fa-envelope absolute left-3 top-3.5 text-gray-400"></i>
                            <input type="email" name="email" value="<?= esc(old('email', $user['email'] ?? '')) ?>"
                                class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-bpjs-accent/50 text-gray-700 transition"
                                required>
                        </div>
                    </div>
                </div>

                <!-- Password -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-lock text-bpjs-primary mr-1"></i>
                        Password
                    </label>
                    <div class="relative">
                        <i class="fas fa-key absolute left-3 top-3.5 text-gray-400"></i>
                        <input type="password" name="password"
                            class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-bpjs-accent/50 text-gray-700 transition"
                            placeholder="Masukkan password baru">
                    </div>
                    <p class="text-xs text-gray-500 mt-2 ml-1">
                        <i class="fas fa-info-circle text-blue-500 mr-1"></i>
                        Kosongkan jika tidak ingin mengubah password
                    </p>
                </div>

                <!-- No HP & Jenis Kelamin -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-phone text-bpjs-primary mr-1"></i>
                            No HP
                        </label>
                        <div class="relative">
                            <i class="fas fa-mobile-alt absolute left-3 top-3.5 text-gray-400"></i>
                            <input type="text" name="no_hp" value="<?= esc(old('no_hp', $user['no_hp'] ?? '')) ?>"
                                class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-bpjs-accent/50 text-gray-700 transition">
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-venus-mars text-bpjs-primary mr-1"></i>
                            Jenis Kelamin
                        </label>
                        <div class="relative">
                            <i class="fas fa-user-friends absolute left-3 top-3.5 text-gray-400"></i>
                            <select name="jenis_kelamin"
                                class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-bpjs-accent/50 text-gray-700 transition appearance-none">
                                <option value="">-- Pilih Jenis Kelamin --</option>
                                <option value="Laki-laki" <?= old('jenis_kelamin', $user['jenis_kelamin'] ?? '') === 'Laki-laki' ? 'selected' : '' ?>>Laki-laki</option>
                                <option value="Perempuan" <?= old('jenis_kelamin', $user['jenis_kelamin'] ?? '') === 'Perempuan' ? 'selected' : '' ?>>Perempuan</option>
                            </select>
                            <i class="fas fa-chevron-down absolute right-3 top-3.5 text-gray-400 pointer-events-none"></i>
                        </div>
                    </div>
                </div>

                <!-- Tanggal Lahir -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-birthday-cake text-bpjs-primary mr-1"></i>
                        Tanggal Lahir
                    </label>
                    <div class="relative">
                        <i class="fas fa-calendar-day absolute left-3 top-3.5 text-gray-400"></i>
                        <input type="date" name="tanggal_lahir" value="<?= esc(old('tanggal_lahir', $user['tanggal_lahir'] ?? '')) ?>"
                            class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-bpjs-accent/50 text-gray-700 transition">
                    </div>
                </div>

                <!-- Alamat -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-map-marker-alt text-bpjs-primary mr-1"></i>
                        Alamat
                    </label>
                    <div class="relative">
                        <i class="fas fa-home absolute left-3 top-3.5 text-gray-400"></i>
                        <textarea name="alamat" rows="3"
                            class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-bpjs-accent/50 text-gray-700 transition"><?= esc(old('alamat', $user['alamat'] ?? '')) ?></textarea>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="flex justify-end gap-4 pt-6 border-t border-gray-200 mt-6">
                    <button type="reset" 
                            class="px-6 py-3 rounded-xl border border-gray-300 text-gray-700 font-medium hover:bg-gray-50 transition flex items-center gap-2">
                        <i class="fas fa-redo"></i> Reset
                    </button>
                    <button type="submit" 
                            class="btn-submit flex items-center gap-2 px-6 py-3 rounded-xl bg-gradient-to-r from-bpjs-accent to-orange-500 text-white font-semibold hover:opacity-90 shadow-lg transition">
                        <i class="fas fa-save"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .form-input:focus {
        box-shadow: 0 0 0 3px rgba(228, 148, 60, 0.2);
        border-color: #e4943c;
    }
    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(228, 148, 60, 0.4);
    }
</style>

<?= $this->endSection() ?>
