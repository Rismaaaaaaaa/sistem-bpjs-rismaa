<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <h1 class="mb-4">Admin Dashboard</h1>
    <div class="card shadow-sm">
        <div class="card-body">
            <h5>Selamat datang, <?= session()->get('username') ?>!</h5>
            <p>Ini adalah dashboard admin untuk mengelola data Jaminan dan BUBM.</p>
            <div class="row">
                <div class="col-md-6">
                    <div class="card bg-light mb-3">
                        <div class="card-body">
                            <h5><i class="fas fa-file-medical me-2"></i> Jaminan</h5>
                            <p>Kelola data jaminan peserta BPJS.</p>
                            <a href="<?= base_url('/admin/jaminan') ?>" class="btn btn-primary btn-sm">Lihat Jaminan</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card bg-light mb-3">
                        <div class="card-body">
                            <h5><i class="fas fa-money-check-alt me-2"></i> BUBM</h5>
                            <p>Kelola data BUBM terkait bantuan medis.</p>
                            <a href="<?= base_url('/admin/bubm') ?>" class="btn btn-primary btn-sm">Lihat BUBM</a>
                        </div>
                    </div>
                </div>
                <?php if (session()->get('role') === 'superadmin'): ?>
                    <div class="col-md-6">
                        <div class="card bg-light mb-3">
                            <div class="card-body">
                                <h5><i class="fas fa-users me-2"></i> Users</h5>
                                <p>Kelola pengguna sistem (khusus superadmin).</p>
                                <a href="<?= base_url('/superadmin/users') ?>" class="btn btn-primary btn-sm">Lihat Users</a>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>