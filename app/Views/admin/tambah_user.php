<?= $this->extend('layouts/main') ?> 
<?= $this->section('content') ?>

<div class="p-6">
    <!-- Header -->
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-2xl font-bold text-bpjs-primary flex items-center gap-3">
                <div class="p-2 rounded-lg bg-bpjs-accent/10">
                    <i class="fas fa-user-plus text-bpjs-accent text-xl"></i>
                </div>
                Tambah User Baru
            </h1>
            <p class="text-gray-600 mt-2 ml-11">Tambahkan user baru untuk akses sistem BPJS Kesehatan</p>
        </div>
        <a href="<?= base_url('admin/users') ?>" 
           class="flex items-center gap-2 px-4 py-2.5 rounded-xl border border-gray-300 text-gray-700 font-medium hover:bg-gray-50 transition">
            <i class="fas fa-arrow-left"></i> Kembali ke Daftar User
        </a>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-200 max-w-4xl mx-auto">
        <!-- Form Header -->
        <div class="bg-gradient-to-r from-bpjs-primary to-bpjs-darkblue text-white p-5">
            <div class="flex items-center gap-3">
                <i class="fas fa-user-cog text-bpjs-accent text-xl"></i>
                <h2 class="text-xl font-semibold">Formulir Pendaftaran User</h2>
            </div>
            <p class="text-blue-100 mt-2 ml-8">Lengkapi semua field yang wajib diisi (<span class="text-red-400">*</span>)</p>
        </div>

        <!-- Notifications -->
        <div class="p-4">
            <?php if (session()->getFlashdata('success')): ?>
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

            <?php if (session()->getFlashdata('errors')): ?>
                <div class="p-4 mb-4 bg-red-50 border-l-4 border-red-500 rounded-r">
                    <div class="flex items-center">
                        <i class="fas fa-exclamation-circle text-red-500 text-lg mr-3"></i>
                        <div>
                            <p class="text-red-700 font-medium">Terjadi Kesalahan:</p>
                            <ul class="text-red-600 text-sm list-disc list-inside mt-1">
                                <?php foreach (session()->getFlashdata('errors') as $error): ?>
                                    <li><?= esc($error) ?></li>
                                <?php endforeach ?>
                            </ul>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <!-- Form Content -->
        <form action="<?= base_url('admin/tambah_user/store') ?>" method="post" class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
            <?= csrf_field() ?>

            <!-- Username -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-user text-bpjs-primary mr-1"></i>
                    Username <span class="text-red-500">*</span>
                </label>
                <div class="relative">
                    <i class="fas fa-user absolute left-3 top-3.5 text-gray-400"></i>
                    <input type="text" name="username" 
                           class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-bpjs-accent/50 text-gray-700 transition"
                           value="<?= old('username') ?>" 
                           placeholder="Masukkan username" 
                           required>
                </div>
            </div>

            <!-- Email -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-envelope text-bpjs-primary mr-1"></i>
                    Email <span class="text-red-500">*</span>
                </label>
                <div class="relative">
                    <i class="fas fa-envelope absolute left-3 top-3.5 text-gray-400"></i>
                    <input type="email" name="email" 
                           class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-bpjs-accent/50 text-gray-700 transition"
                           value="<?= old('email') ?>" 
                           placeholder="contoh@email.com" 
                           required>
                </div>
            </div>

            <!-- Password -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-lock text-bpjs-primary mr-1"></i>
                    Password <span class="text-red-500">*</span>
                </label>
                <div class="relative">
                    <i class="fas fa-key absolute left-3 top-3.5 text-gray-400"></i>
                    <input type="password" name="password" 
                           class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-bpjs-accent/50 text-gray-700 transition"
                           placeholder="Minimal 8 karakter" 
                           required
                           minlength="8">
                </div>
                <p class="text-xs text-gray-500 mt-2 ml-1">
                    <i class="fas fa-info-circle text-blue-500 mr-1"></i>
                    Password harus minimal 8 karakter
                </p>
            </div>

            <!-- Role -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-user-tag text-bpjs-primary mr-1"></i>
                    Role <span class="text-red-500">*</span>
                </label>
                <div class="relative">
                    <i class="fas fa-shield-alt absolute left-3 top-3.5 text-gray-400"></i>
                    <select name="role" 
                            class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-bpjs-accent/50 text-gray-700 transition appearance-none"
                            required>
                        <option value="">-- Pilih Role --</option>
                        <option value="admin" <?= old('role') == 'admin' ? 'selected' : '' ?>>Admin</option>
                        <option value="superadmin" <?= old('role') == 'superadmin' ? 'selected' : '' ?>>Superadmin</option>
                    </select>
                    <i class="fas fa-chevron-down absolute right-3 top-3.5 text-gray-400 pointer-events-none"></i>
                </div>
            </div>

            <!-- Jenis Kelamin -->
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
                        <option value="Laki-laki" <?= old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' ?>>Laki-laki</option>
                        <option value="Perempuan" <?= old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' ?>>Perempuan</option>
                    </select>
                    <i class="fas fa-chevron-down absolute right-3 top-3.5 text-gray-400 pointer-events-none"></i>
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
                    <input type="date" name="tanggal_lahir" 
                           class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-bpjs-accent/50 text-gray-700 transition"
                           value="<?= old('tanggal_lahir') ?>">
                </div>
            </div>

            <!-- No HP -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-phone text-bpjs-primary mr-1"></i>
                    No HP
                </label>
                <div class="relative">
                    <i class="fas fa-mobile-alt absolute left-3 top-3.5 text-gray-400"></i>
                    <input type="text" name="no_hp" 
                           class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-bpjs-accent/50 text-gray-700 transition"
                           value="<?= old('no_hp') ?>" 
                           placeholder="Contoh: 081234567890">
                </div>
            </div>

            <!-- Alamat -->
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-map-marker-alt text-bpjs-primary mr-1"></i>
                    Alamat
                </label>
                <div class="relative">
                    <i class="fas fa-home absolute left-3 top-3.5 text-gray-400"></i>
                    <textarea name="alamat" rows="3"
                              class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-bpjs-accent/50 text-gray-700 transition"
                              placeholder="Masukkan alamat lengkap"><?= old('alamat') ?></textarea>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="md:col-span-2 flex justify-end gap-4 pt-6 border-t border-gray-200 mt-4">
                <button type="reset" 
                        class="px-6 py-3 rounded-xl border border-gray-300 text-gray-700 font-medium hover:bg-gray-50 transition flex items-center gap-2">
                    <i class="fas fa-redo"></i> Reset Form
                </button>
                <button type="submit" 
                        class="btn-submit flex items-center gap-2 px-6 py-3 rounded-xl bg-gradient-to-r from-bpjs-accent to-orange-500 text-white font-semibold hover:opacity-90 shadow-lg transition">
                    <i class="fas fa-save"></i> Simpan User
                </button>
            </div>
        </form>
    </div>

    <!-- Info Box -->
    <div class="bg-blue-50 border-l-4 border-bpjs-primary p-4 rounded-r mt-6 max-w-4xl mx-auto">
        <div class="flex items-start">
            <div class="flex-shrink-0">
                <i class="fas fa-info-circle text-bpjs-primary text-lg mt-1"></i>
            </div>
            <div class="ml-3">
                <h3 class="text-sm font-medium text-bpjs-primary">Informasi Penting</h3>
                <div class="text-sm text-gray-600 mt-2">
                    <ul class="list-disc list-inside space-y-1">
                        <li>Username harus unik dan tidak boleh mengandung spasi</li>
                        <li>Email akan digunakan untuk verifikasi dan notifikasi</li>
                        <li>Password harus minimal 8 karakter dan mengandung huruf serta angka</li>
                        <li>Superadmin memiliki akses penuh ke semua fitur sistem</li>
                    </ul>
                </div>
            </div>
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Password strength indicator
        const passwordInput = document.querySelector('input[name="password"]');
        
        passwordInput.addEventListener('input', function() {
            const password = this.value;
            const strengthIndicator = document.getElementById('passwordStrength');
            
            if (password.length === 0) {
                if (strengthIndicator) strengthIndicator.textContent = '';
                return;
            }
            
            let strength = 'Lemah';
            let color = 'text-red-500';
            
            if (password.length >= 12) {
                strength = 'Sangat Kuat';
                color = 'text-green-500';
            } else if (password.length >= 8) {
                strength = 'Kuat';
                color = 'text-green-400';
            } else if (password.length >= 6) {
                strength = 'Sedang';
                color = 'text-yellow-500';
            }
            
            if (strengthIndicator) {
                strengthIndicator.textContent = `Kekuatan: ${strength}`;
                strengthIndicator.className = `text-xs ${color} mt-1 ml-1`;
            }
        });
        
        // Phone number formatting
        const phoneInput = document.querySelector('input[name="no_hp"]');
        
        phoneInput.addEventListener('input', function() {
            this.value = this.value.replace(/[^\d]/g, '');
        });
    });
</script>

<?= $this->endSection() ?>