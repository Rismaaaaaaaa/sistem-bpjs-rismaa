<?php
// Ambil active_menu dari data controller, kalau ga ada default ke 'dashboard'
$active_menu = isset($active_menu) ? $active_menu : 'dashboard';
?>

<div class="sidenav" id="sidenav">
    <div class="brand">
        <i class="fas fa-shield-alt me-2"></i> BPJS Admin
    </div>
    <nav class="nav flex-column">
        <a class="nav-link <?= $active_menu === 'dashboard' ? 'active' : '' ?>" href="<?= base_url('/admin/dashboard') ?>" aria-label="Dashboard">
            <i class="fas fa-tachometer-alt"></i> Dashboard
        </a>
        <a class="nav-link <?= $active_menu === 'jaminan' ? 'active' : '' ?>" href="<?= base_url('/admin/jaminan') ?>" aria-label="Kelola Jaminan">
            <i class="fas fa-file-medical"></i> Jaminan
        </a>
        <a class="nav-link <?= $active_menu === 'bubm' ? 'active' : '' ?>" href="<?= base_url('/admin/bubm') ?>" aria-label="Kelola BUBM">
            <i class="fas fa-money-check-alt"></i> BUBM
        </a>
        <?php if (session()->get('role') === 'superadmin'): ?>
            <a class="nav-link <?= $active_menu === 'users' ? 'active' : '' ?>" href="<?= base_url('/superadmin/users') ?>" aria-label="Kelola Users">
                <i class="fas fa-users"></i> Users
            </a>
        <?php endif; ?>
        <a class="nav-link" href="<?= base_url('/auth/logout') ?>" aria-label="Logout">
            <i class="fas fa-sign-out-alt"></i> Logout
        </a>
    </nav>
</div>