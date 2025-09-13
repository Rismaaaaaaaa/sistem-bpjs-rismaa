<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Settings Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

<div class="max-w-3xl mx-auto mt-10 bg-white p-8 rounded-xl shadow">
    <h2 class="text-2xl font-bold mb-6">Pengaturan Akun</h2>

    <?php if(session()->getFlashdata('success')): ?>
        <div class="bg-green-100 text-green-700 px-4 py-2 rounded mb-4">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <form action="<?= base_url('admin/settings/update') ?>" method="post" class="space-y-4">
        <div>
            <label class="block mb-1">Username</label>
            <input type="text" name="username" value="<?= esc($user['username']) ?>" class="w-full border rounded p-2">
        </div>

        <div>
            <label class="block mb-1">Email</label>
            <input type="email" name="email" value="<?= esc($user['email']) ?>" class="w-full border rounded p-2">
        </div>

        <div>
            <label class="block mb-1">Password (kosongkan jika tidak diubah)</label>
            <input type="password" name="password" class="w-full border rounded p-2">
        </div>

        <div>
            <label class="block mb-1">Alamat</label>
            <textarea name="alamat" class="w-full border rounded p-2"><?= esc($user['alamat']) ?></textarea>
        </div>

        <div>
            <label class="block mb-1">No HP</label>
            <input type="text" name="no_hp" value="<?= esc($user['no_hp']) ?>" class="w-full border rounded p-2">
        </div>

        <div>
            <label class="block mb-1">Jenis Kelamin</label>
            <select name="jenis_kelamin" class="w-full border rounded p-2">
                <option value="">-- Pilih --</option>
                <option value="Laki-laki" <?= $user['jenis_kelamin'] == 'Laki-laki' ? 'selected' : '' ?>>Laki-laki</option>
                <option value="Perempuan" <?= $user['jenis_kelamin'] == 'Perempuan' ? 'selected' : '' ?>>Perempuan</option>
            </select>
        </div>

        <div>
            <label class="block mb-1">Tanggal Lahir</label>
            <input type="date" name="tanggal_lahir" value="<?= esc($user['tanggal_lahir']) ?>" class="w-full border rounded p-2">
        </div>

        <div>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
        </div>
    </form>
</div>

</body>
</html>
