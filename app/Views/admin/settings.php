<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<div class="max-w-2xl mx-auto bg-white shadow-lg rounded-2xl p-6">
    <h2 class="text-2xl font-bold text-gray-700 mb-6 flex items-center gap-2">
        <i class="fas fa-user-cog text-bpjs-primary"></i>
        Pengaturan Akun
    </h2>

    <?php if(session()->getFlashdata('success')): ?>
        <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <?php if(session()->getFlashdata('errors')): ?>
        <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg">
            <ul class="list-disc list-inside">
                <?php foreach(session()->getFlashdata('errors') as $error): ?>
                    <li><?= esc($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form action="<?= site_url('admin/settings/update') ?>" method="post" class="space-y-4">
        <?= csrf_field() ?>
        <div>
            <label class="block mb-1 font-medium">Username</label>
            <input type="text" name="username" value="<?= esc(old('username', $user['username'] ?? '')) ?>"
                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-bpjs-accent/50">
        </div>
        <div>
            <label class="block mb-1 font-medium">Email</label>
            <input type="email" name="email" value="<?= esc(old('email', $user['email'] ?? '')) ?>"
                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-bpjs-accent/50">
        </div>
        <div>
            <label class="block mb-1 font-medium">Password (kosongkan jika tidak ingin ganti)</label>
            <input type="password" name="password"
                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-bpjs-accent/50">
        </div>
        <div>
            <label class="block mb-1 font-medium">Alamat</label>
            <textarea name="alamat" rows="3"
                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-bpjs-accent/50"><?= esc(old('alamat', $user['alamat'] ?? '')) ?></textarea>
        </div>
        <div>
            <label class="block mb-1 font-medium">No HP</label>
            <input type="text" name="no_hp" value="<?= esc(old('no_hp', $user['no_hp'] ?? '')) ?>"
                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-bpjs-accent/50">
        </div>
        <div>
            <label class="block mb-1 font-medium">Jenis Kelamin</label>
            <select name="jenis_kelamin"
                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-bpjs-accent/50">
                <option value="">-- Pilih --</option>
                <option value="Laki-laki" <?= old('jenis_kelamin', $user['jenis_kelamin'] ?? '') === 'Laki-laki' ? 'selected' : '' ?>>Laki-laki</option>
                <option value="Perempuan" <?= old('jenis_kelamin', $user['jenis_kelamin'] ?? '') === 'Perempuan' ? 'selected' : '' ?>>Perempuan</option>
            </select>
        </div>
        <div>
            <label class="block mb-1 font-medium">Tanggal Lahir</label>
            <input type="date" name="tanggal_lahir" value="<?= esc(old('tanggal_lahir', $user['tanggal_lahir'] ?? '')) ?>"
                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-bpjs-accent/50">
        </div>
        <div class="flex justify-end gap-3">
            <button type="reset" class="px-4 py-2 border rounded-lg text-gray-700 hover:bg-gray-100">Reset</button>
            <button type="submit" class="px-4 py-2 bg-bpjs-primary text-white rounded-lg hover:bg-bpjs-darkblue">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
<?= $this->endSection() ?>