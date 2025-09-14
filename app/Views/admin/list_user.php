<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="p-6 mt-14">
    <!-- Header -->
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-2xl font-bold text-bpjs-primary flex items-center gap-3">
                <div class="p-2 rounded-lg bg-bpjs-accent/10">
                    <i class="fas fa-users-cog text-bpjs-accent text-xl"></i>
                </div>
                Manajemen Pengguna Sistem
            </h1>
            <p class="text-gray-600 mt-2 ml-11">Kelola semua pengguna sistem BPJS Kesehatan</p>
        </div>
        <a href="<?= site_url('admin/tambah_user') ?>" 
           class="flex items-center gap-2 px-5 py-2.5 rounded-xl bg-gradient-to-r from-bpjs-accent to-orange-500 text-white font-semibold hover:opacity-90 shadow-lg transition">
            <i class="fas fa-user-plus"></i> Tambah User Baru
        </a>
    </div>



    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
        <div class="bg-white rounded-2xl shadow-sm p-4 border border-gray-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Total Users</p>
                    <h3 class="text-2xl font-bold text-gray-800"><?= count($users) ?></h3>
                </div>
                <div class="p-3 rounded-lg bg-blue-100">
                    <i class="fas fa-users text-blue-600 text-xl"></i>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-2xl shadow-sm p-4 border border-gray-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Admin</p>
                    <h3 class="text-2xl font-bold text-gray-800">
                        <?= count(array_filter($users, fn($user) => $user['role'] === 'admin')) ?>
                    </h3>
                </div>
                <div class="p-3 rounded-lg bg-green-100">
                    <i class="fas fa-user-shield text-green-600 text-xl"></i>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-2xl shadow-sm p-4 border border-gray-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Superadmin</p>
                    <h3 class="text-2xl font-bold text-gray-800">
                        <?= count(array_filter($users, fn($user) => $user['role'] === 'superadmin')) ?>
                    </h3>
                </div>
                <div class="p-3 rounded-lg bg-purple-100">
                    <i class="fas fa-crown text-purple-600 text-xl"></i>
                </div>
            </div>
        </div>
        
        
    </div>

    <!-- Table Container -->
    <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-200">
        <!-- Table Header -->
        <div class="bg-gradient-to-r from-bpjs-primary to-bpjs-darkblue text-white p-5">
            <div class="flex items-center gap-3">
                <i class="fas fa-list text-bpjs-accent text-xl"></i>
                <h2 class="text-xl font-semibold">Daftar Pengguna Sistem</h2>
            </div>
            <p class="text-blue-100 mt-2 ml-8"><?= count($users) ?> pengguna terdaftar</p>
        </div>

        <!-- Search and Filter -->
        <div class="p-5 bg-gray-50 border-b border-gray-200">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-search text-bpjs-primary mr-1"></i>
                        Cari Pengguna
                    </label>
                    <div class="relative">
                        <i class="fas fa-search absolute left-3 top-3.5 text-gray-400"></i>
                        <input type="text" placeholder="Cari berdasarkan username, email, atau role..." 
                               class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-bpjs-accent/50 text-gray-700 transition">
                    </div>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-filter text-bpjs-primary mr-1"></i>
                        Filter Role
                    </label>
                    <div class="relative">
                        <i class="fas fa-user-tag absolute left-3 top-3.5 text-gray-400"></i>
                        <select id="roleFilter"  class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-bpjs-accent/50 text-gray-700 transition appearance-none">
                            <option value="all">Semua Role</option>
                            <option value="admin">Admin</option>
                            <option value="superadmin">Superadmin</option>
                        </select>
                        <i class="fas fa-chevron-down absolute right-3 top-3.5 text-gray-400 pointer-events-none"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="p-4 text-left font-semibold text-gray-700 text-sm uppercase">#</th>
                        <th class="p-4 text-left font-semibold text-gray-700 text-sm uppercase">User</th>
                        <th class="p-4 text-left font-semibold text-gray-700 text-sm uppercase">Kontak</th>
                        <th class="p-4 text-left font-semibold text-gray-700 text-sm uppercase">Role</th>
                        <th class="p-4 text-left font-semibold text-gray-700 text-sm uppercase">Info</th>
                        <th class="p-4 text-left font-semibold text-gray-700 text-sm uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <?php if (!empty($users)): ?>
                        <?php foreach ($users as $i => $user): ?>
                            <tr class="hover:bg-gray-50/50 transition-colors duration-150">
                                <td class="p-4 whitespace-nowrap">
                                    <div class="w-8 h-8 rounded-full bg-gradient-to-r from-bpjs-primary to-blue-600 flex items-center justify-center text-white font-bold">
                                        <?= $i + 1 ?>
                                    </div>
                                </td>
                                
                                <td class="p-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-full bg-gradient-to-r from-bpjs-accent to-orange-400 flex items-center justify-center text-white">
                                            <?= strtoupper(substr($user['username'], 0, 2)) ?>
                                        </div>
                                        <div>
                                            <p class="font-medium text-gray-900"><?= esc($user['username']) ?></p>
                                            <p class="text-sm text-gray-500">ID: <?= $user['id'] ?></p>
                                        </div>
                                    </div>
                                </td>
                                
                                <td class="p-4">
                                    <p class="text-gray-900"><?= esc($user['email']) ?></p>
                                    <p class="text-sm text-gray-500"><?= esc($user['no_hp']) ?></p>
                                </td>
                                
                                <td class="p-4">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium 
                                        <?= $user['role'] === 'superadmin' 
                                            ? 'bg-red-100 text-red-800' 
                                            : 'bg-blue-100 text-blue-800' ?>">
                                        <i class="fas <?= $user['role'] === 'superadmin' ? 'fa-crown' : 'fa-user-shield' ?> mr-2"></i>
                                        <?= esc($user['role']) ?>
                                    </span>
                                </td>
                                
                                <td class="p-4">
                                    <p class="text-sm text-gray-600">
                                        <i class="fas fa-venus-mars text-gray-400 mr-2"></i>
                                        <?= esc($user['jenis_kelamin']) ?>
                                    </p>
                                    <p class="text-sm text-gray-600">
                                        <i class="fas fa-birthday-cake text-gray-400 mr-2"></i>
                                        <?= esc($user['tanggal_lahir']) ?>
                                    </p>
                                </td>
                                
                                <td class="p-4">
                                    <div class="flex items-center gap-2">
                                        <!-- View Button -->
                                        <button onclick="viewUser(<?= htmlspecialchars(json_encode($user), ENT_QUOTES, 'UTF-8') ?>)"
                                                class="p-2 rounded-lg bg-green-100 text-green-600 hover:bg-green-200 transition-colors duration-200"
                                                title="Lihat Detail">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <!-- Edit Button -->
                                       <!-- Tombol Edit -->
                                        <button 
                                            type="button"
                                            class="p-2 rounded-lg bg-blue-100 text-blue-600 hover:bg-blue-200 transition-colors duration-200"
                                            title="Edit User"
                                            onclick="openEditModal(
                                                <?= $user['id'] ?>,
                                                '<?= $user['username'] ?>',
                                                '<?= $user['email'] ?>',
                                                '<?= $user['role'] ?>',
                                                '<?= $user['alamat'] ?>',
                                                '<?= $user['no_hp'] ?>',
                                                '<?= $user['jenis_kelamin'] ?>',
                                                '<?= $user['tanggal_lahir'] ?>'
                                            )">
                                            <i class="fas fa-edit"></i>
                                        </button>

                                        
                                        
                                        <!-- Delete Button -->
                                        <a href="<?= site_url('admin/users/delete/'.$user['id']) ?>" 
                                           onclick="return confirm('Yakin ingin menghapus user <?= esc($user['username']) ?>?')"
                                           class="p-2 rounded-lg bg-red-100 text-red-600 hover:bg-red-200 transition-colors duration-200"
                                           title="Hapus User">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="p-8 text-center">
                                <div class="flex flex-col items-center justify-center text-gray-400 py-8">
                                    <i class="fas fa-users text-4xl mb-3 opacity-30"></i>
                                    <p class="text-lg font-medium">Belum ada data pengguna</p>
                                    <p class="text-sm mt-1">Mulai dengan menambahkan user baru</p>
                                    <a href="<?= site_url('admin/tambah_user') ?>" 
                                       class="mt-4 px-4 py-2 bg-bpjs-primary text-white rounded-lg hover:bg-blue-800 transition">
                                        <i class="fas fa-plus mr-2"></i> Tambah User Pertama
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        
        <!-- Table Footer -->
        <?php if (!empty($users)): ?>
        <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
            <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                <p class="text-sm text-gray-700">
                    Menampilkan <span class="font-medium"><?= count($users) ?></span> dari 
                    <span class="font-medium"><?= count($users) ?></span> pengguna
                </p>
                
              
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>

<!-- User Detail Modal -->
<div id="userDetailModal" class="fixed inset-0 hidden bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md transform transition-all duration-300 scale-95 opacity-0">
        <!-- Modal content will be filled by JavaScript -->
    </div>
</div>

<div id="editUserModal" class="fixed inset-0 hidden bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-2xl transform transition-all duration-300 scale-95 opacity-0">
        <!-- Modal Header -->
        <div class="bg-gradient-to-r from-bpjs-primary to-bpjs-darkblue text-white p-5 relative">
            <div class="flex items-center gap-3">
                <div class="p-2 rounded-lg bg-white/10">
                    <i class="fas fa-user-edit text-bpjs-accent text-xl"></i>
                </div>
                <h2 class="text-xl font-semibold">Edit Data Pengguna</h2>
            </div>
            <button type="button" onclick="closeEditModal()" 
                    class="absolute top-4 right-4 text-white hover:text-bpjs-accent transition">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>

        <!-- Form Content -->
        <form action="<?= site_url('admin/users/update') ?>" method="post" class="p-6 max-h-[70vh] overflow-y-auto">
            <input type="hidden" name="id" id="edit_id">
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Username -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-user text-bpjs-primary mr-1"></i>
                        Username <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <i class="fas fa-user absolute left-3 top-3.5 text-gray-400"></i>
                        <input type="text" name="username" id="edit_username" 
                               class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-bpjs-accent/50 text-gray-700 transition"
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
                        <input type="email" name="email" id="edit_email" 
                               class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-bpjs-accent/50 text-gray-700 transition"
                               required>
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
                        <input type="password" name="password" id="edit_password" 
                               class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-bpjs-accent/50 text-gray-700 transition"
                               placeholder="Kosongkan jika tidak diubah">
                    </div>
                    <p class="text-xs text-gray-500 mt-2 ml-1">
                        <i class="fas fa-info-circle text-blue-500 mr-1"></i>
                        Biarkan kosong untuk mempertahankan password lama
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
                        <select name="role" id="edit_role" 
                                class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-bpjs-accent/50 text-gray-700 transition appearance-none">
                            <option value="admin">Admin</option>
                            <option value="superadmin">Superadmin</option>
                        </select>
                        <i class="fas fa-chevron-down absolute right-3 top-3.5 text-gray-400 pointer-events-none"></i>
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
                        <input type="text" name="no_hp" id="edit_no_hp" 
                               class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-bpjs-accent/50 text-gray-700 transition">
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
                        <select name="jenis_kelamin" id="edit_jenis_kelamin" 
                                class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-bpjs-accent/50 text-gray-700 transition appearance-none">
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
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
                        <input type="date" name="tanggal_lahir" id="edit_tanggal_lahir" 
                               class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-bpjs-accent/50 text-gray-700 transition">
                    </div>
                </div>
            </div>

            <!-- Alamat -->
            <div class="mt-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-map-marker-alt text-bpjs-primary mr-1"></i>
                    Alamat
                </label>
                <div class="relative">
                    <i class="fas fa-home absolute left-3 top-3.5 text-gray-400"></i>
                    <textarea name="alamat" id="edit_alamat" rows="3"
                              class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-bpjs-accent/50 text-gray-700 transition"></textarea>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="flex justify-end gap-4 pt-6 border-t border-gray-200 mt-6">
                <button type="button" onclick="closeEditModal()" 
                        class="px-6 py-3 rounded-xl border border-gray-300 text-gray-700 font-medium hover:bg-gray-50 transition flex items-center gap-2">
                    <i class="fas fa-times"></i> Batal
                </button>
                <button type="submit" 
                        class="btn-submit flex items-center gap-2 px-6 py-3 rounded-xl bg-gradient-to-r from-bpjs-accent to-orange-500 text-white font-semibold hover:opacity-90 shadow-lg transition">
                    <i class="fas fa-save"></i> Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>

<style>
    #editUserModal .transform {
        transition: transform 0.3s ease-out, opacity 0.3s ease-out;
    }
    
    #editUserModal:not(.hidden) .transform {
        transform: scale(1);
        opacity: 1;
    }
    
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
    // Function to open edit modal with user data
    function openEditModal(user) {
        const modal = document.getElementById('editUserModal');
        const modalContent = modal.querySelector('.transform');
        
        // Fill form with user data
        document.getElementById('edit_id').value = user.id;
        document.getElementById('edit_username').value = user.username;
        document.getElementById('edit_email').value = user.email;
        document.getElementById('edit_role').value = user.role;
        document.getElementById('edit_alamat').value = user.alamat || '';
        document.getElementById('edit_no_hp').value = user.no_hp || '';
        document.getElementById('edit_jenis_kelamin').value = user.jenis_kelamin || '';
        document.getElementById('edit_tanggal_lahir').value = user.tanggal_lahir || '';
        
        // Show modal with animation
        modal.classList.remove('hidden');
        setTimeout(() => {
            modalContent.classList.remove('scale-95', 'opacity-0');
        }, 10);
    }
    
    // Function to close edit modal
    function closeEditModal() {
        const modal = document.getElementById('editUserModal');
        const modalContent = modal.querySelector('.transform');
        
        modalContent.classList.add('scale-95', 'opacity-0');
        setTimeout(() => {
            modal.classList.add('hidden');
        }, 300);
    }
    
    // Close modal when clicking outside
    document.getElementById('editUserModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeEditModal();
        }
    });
    
    // Phone number formatting
    document.addEventListener('DOMContentLoaded', function() {
        const phoneInput = document.getElementById('edit_no_hp');
        
        if (phoneInput) {
            phoneInput.addEventListener('input', function() {
                this.value = this.value.replace(/[^\d]/g, '');
            });
        }
    });
</script>


<style>
    table th, table td {
        border-bottom: 1px solid #e5e7eb;
    }
    
    #userDetailModal .transform {
        transition: transform 0.3s ease-out, opacity 0.3s ease-out;
    }
    
    #userDetailModal:not(.hidden) .transform {
        transform: scale(1);
        opacity: 1;
    }
</style>


<script>
  function openEditModal(id, username, email, role, alamat, no_hp, jenis_kelamin, tanggal_lahir) {
      document.getElementById('edit_id').value = id;
      document.getElementById('edit_username').value = username;
      document.getElementById('edit_email').value = email;
      document.getElementById('edit_role').value = role;
      document.getElementById('edit_alamat').value = alamat;
      document.getElementById('edit_no_hp').value = no_hp;
      document.getElementById('edit_jenis_kelamin').value = jenis_kelamin;
      document.getElementById('edit_tanggal_lahir').value = tanggal_lahir;
      document.getElementById('edit_password').value = ""; // kosong default
      document.getElementById('editUserModal').classList.remove('hidden');
  }

  function closeEditModal() {
      document.getElementById('editUserModal').classList.add('hidden');
  }
</script>





<script>
    // Function to view user details
    function viewUser(user) {
        const modal = document.getElementById('userDetailModal');
        const modalContent = modal.querySelector('.transform');
        
        modalContent.innerHTML = `
            <div class="bg-gradient-to-r from-bpjs-primary to-bpjs-darkblue text-white p-5 rounded-t-2xl">
                <div class="flex items-center gap-3">
                    <div class="p-2 rounded-lg bg-white/10">
                        <i class="fas fa-user-circle text-bpjs-accent text-xl"></i>
                    </div>
                    <h2 class="text-xl font-semibold">Detail Pengguna</h2>
                </div>
                <button class="absolute top-4 right-4 text-white hover:text-bpjs-accent transition" onclick="closeModal()">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            
            <div class="p-6 space-y-4">
                <div class="flex items-center justify-center mb-6">
                    <div class="w-20 h-20 rounded-full bg-gradient-to-r from-bpjs-accent to-orange-500 flex items-center justify-center text-white text-2xl font-bold">
                        ${user.username.substring(0, 2).toUpperCase()}
                    </div>
                </div>
                
                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-gray-50 p-3 rounded-lg">
                        <p class="text-sm text-gray-500">Username</p>
                        <p class="font-medium">${user.username}</p>
                    </div>
                    <div class="bg-gray-50 p-3 rounded-lg">
                        <p class="text-sm text-gray-500">Email</p>
                        <p class="font-medium">${user.email}</p>
                    </div>
                </div>
                
                <div class="bg-gray-50 p-3 rounded-lg">
                    <p class="text-sm text-gray-500">Role</p>
                    <p class="font-medium">
                        <span class="inline-flex items-center px-2 py-1 rounded-full text-sm font-medium 
                            ${user.role === 'superadmin' ? 'bg-red-100 text-red-800' : 'bg-blue-100 text-blue-800'}">
                            <i class="fas ${user.role === 'superadmin' ? 'fa-crown' : 'fa-user-shield'} mr-2"></i>
                            ${user.role}
                        </span>
                    </p>
                </div>
                
                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-gray-50 p-3 rounded-lg">
                        <p class="text-sm text-gray-500">Jenis Kelamin</p>
                        <p class="font-medium">${user.jenis_kelamin || '-'}</p>
                    </div>
                    <div class="bg-gray-50 p-3 rounded-lg">
                        <p class="text-sm text-gray-500">Tanggal Lahir</p>
                        <p class="font-medium">${user.tanggal_lahir || '-'}</p>
                    </div>
                </div>
                
                <div class="bg-gray-50 p-3 rounded-lg">
                    <p class="text-sm text-gray-500">No HP</p>
                    <p class="font-medium">${user.no_hp || '-'}</p>
                </div>

                <!-- 🆕 Alamat full width -->
                <div class="bg-gray-50 p-3 rounded-lg">
                    <p class="text-sm text-gray-500">Alamat</p>
                    <p class="font-medium">${user.alamat || '-'}</p>
                </div>
            </div>
            
            <div class="px-6 py-4 bg-gray-100 flex justify-end gap-3 rounded-b-2xl">
                <button onclick="closeModal()" class="px-4 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-200 transition">
                    Tutup
                </button>
               
            </div>
        `;

        
        modal.classList.remove('hidden');
        setTimeout(() => {
            modalContent.classList.remove('scale-95', 'opacity-0');
        }, 10);
    }
    
    function closeModal() {
        const modal = document.getElementById('userDetailModal');
        const modalContent = modal.querySelector('.transform');
        
        modalContent.classList.add('scale-95', 'opacity-0');
        setTimeout(() => {
            modal.classList.add('hidden');
        }, 300);
    }
    
    // Close modal when clicking outside
    document.getElementById('userDetailModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeModal();
        }
    });
    
    // Search functionality
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.querySelector('input[type="text"]');
        const rows = document.querySelectorAll('tbody tr');
        
        searchInput.addEventListener('keyup', function() {
            const searchText = this.value.toLowerCase();
            
            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                if (text.includes(searchText)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    });

        // JS untuk filter role
    document.getElementById('roleFilter').addEventListener('change', function () {
        const selectedRole = this.value;
        const rows = document.querySelectorAll('#userTable tr');

        rows.forEach(row => {
            const role = row.getAttribute('data-role');
            if (selectedRole === 'all' || role === selectedRole) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
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

<?= $this->endSection() ?>