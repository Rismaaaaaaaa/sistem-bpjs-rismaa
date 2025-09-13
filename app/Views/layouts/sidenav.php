<?php
// Ambil active_menu dari controller, default ke 'dashboard' kalau ga ada
$active_menu = isset($active_menu) ? $active_menu : 'dashboard';
?>

<style>
    :root {
        --bpjs-primary: #1a56db;
        --bpjs-darkblue: #1e3a8a;
        --bpjs-accent: #f59e0b;
        --bpjs-light: #f0f7ff;
        --bpjs-card: rgba(255, 255, 255, 0.08);
        --transition-speed: 0.3s;
    }
    .sidenav-modern {
        width: 280px;
        height: 100vh;
        position: fixed;
        top: 0;
        left: 0;
        background: linear-gradient(165deg, var(--bpjs-primary) 0%, var(--bpjs-darkblue) 100%);
        color: white;
        display: flex;
        flex-direction: column;
        overflow: hidden;
        z-index: 50;
        box-shadow: 0 0 40px rgba(0, 0, 0, 0.15);
    }
    .sidenav-modern::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle at center, rgba(255, 255, 255, 0.1) 0%, transparent 60%);
        opacity: 0.5;
    }
    .brand-header-modern {
        padding: 24px 20px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        position: relative;
        z-index: 1;
    }
    .brand-logo-modern {
        display: flex;
        align-items: center;
        gap: 12px;
    }
    .logo-icon-modern {
        width: 36px;
        height: 36px;
        background: linear-gradient(135deg, var(--bpjs-accent) 0%, #f97316 100%);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 10px rgba(245, 158, 11, 0.3);
    }
    .logo-text-modern {
        font-size: 22px;
        font-weight: 800;
        background: linear-gradient(to right, #fde68a, #f59e0b);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
    .brand-subtitle-modern {
        font-size: 12px;
        color: rgba(255, 255, 255, 0.7);
        margin-top: 4px;
        margin-left: 48px;
        letter-spacing: 0.5px;
    }
    .nav-modern {
        padding: 16px 12px;
        position: relative;
        z-index: 1;
        height: calc(100% - 160px);
        display: flex;
        flex-direction: column;
        overflow-y: auto;
    }
    .nav-item-modern {
        display: flex;
        align-items: center;
        padding: 14px 16px;
        margin-bottom: 8px;
        border-radius: 12px;
        color: rgba(255, 255, 255, 0.9);
        text-decoration: none;
        transition: all var(--transition-speed) ease;
        position: relative;
        overflow: hidden;
    }
    .nav-item-modern::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
        transition: left 0.7s ease;
    }
    .nav-item-modern:hover::before {
        left: 100%;
    }
    .nav-item-modern:hover {
        background: rgba(255, 255, 255, 0.1);
        transform: translateX(5px);
    }
    .nav-item-modern.active {
        background: rgba(255, 255, 255, 0.15);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }
    .nav-item-modern.active .item-icon-modern {
        background: linear-gradient(135deg, var(--bpjs-accent) 0%, #f97316 100%);
        color: white;
    }
    .item-icon-modern {
        width: 38px;
        height: 38px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 12px;
        background: rgba(255, 255, 255, 0.1);
        transition: all var(--transition-speed) ease;
    }
    .item-text-modern {
        font-weight: 500;
        font-size: 15px;
    }
    .nav-divider-modern {
        height: 1px;
        background: rgba(255, 255, 255, 0.1);
        margin: 16px 0;
    }
    .logout-section-modern {
        margin-top: auto;
        padding: 16px 12px;
        position: relative;
        z-index: 1;
        border-top: 1px solid rgba(255, 255, 255, 0.1);
    }
    .logout-btn-modern {
        display: flex;
        align-items: center;
        padding: 14px 16px;
        border-radius: 12px;
        color: rgba(255, 255, 255, 0.9);
        text-decoration: none;
        transition: all var(--transition-speed) ease;
        background: rgba(239, 68, 68, 0.2);
    }
    .logout-btn-modern:hover {
        background: rgba(239, 68, 68, 0.3);
        transform: translateX(5px);
    }
    .logout-btn-modern .item-icon-modern {
        background: rgba(239, 68, 68, 0.2);
        color: #f87171;
    }
    /* Scrollbar styling */
    .nav-modern::-webkit-scrollbar {
        width: 4px;
    }
    .nav-modern::-webkit-scrollbar-track {
        background: rgba(255, 255, 255, 0.05);
        border-radius: 10px;
    }
    .nav-modern::-webkit-scrollbar-thumb {
        background: rgba(255, 255, 255, 0.2);
        border-radius: 10px;
    }
    .nav-modern::-webkit-scrollbar-thumb:hover {
        background: rgba(255, 255, 255, 0.3);
    }
</style>



<div class="sidenav-modern">
    <!-- Brand Header -->
    <div class="brand-header-modern">
        <div class="brand-logo-modern d-flex align-items-center">
            <div class="logo-img-modern">
                <img src="<?= base_url('assets/images/logo-bpjs.png') ?>" alt="Logo BPJS" width="40">

            </div>
            <div class="logo-text-wrapper ms-2">
                <span class="logo-text-modern fw-bold fs-5">BPJS</span>
                <div class="brand-subtitle-modern text-muted small">Healthcare Administration</div>
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="nav-modern">
        <a href="<?= base_url('/admin/dashboard') ?>" class="nav-item-modern <?= $active_menu === 'dashboard' ? 'active' : '' ?>">
            <div class="item-icon-modern">
                <i class="fas fa-home"></i>
            </div>
            <span class="item-text-modern">Dashboard</span>
        </a>
        <a href="<?= base_url('/admin/jaminan') ?>" class="nav-item-modern <?= $active_menu === 'jaminan' ? 'active' : '' ?>">
            <div class="item-icon-modern">
                <i class="fas fa-file-medical"></i>
            </div>
            <span class="item-text-modern">Input Jaminan</span>
        </a>
        <a href="<?= base_url('/admin/bubm') ?>" class="nav-item-modern <?= $active_menu === 'bubm' ? 'active' : '' ?>">
            <div class="item-icon-modern">
                <i class="fas fa-credit-card"></i>
            </div>
            <span class="item-text-modern">Input BUBM</span>
        </a>
        <a href="<?= base_url('/admin/laporan') ?>" class="nav-item-modern <?= $active_menu === 'laporan' ? 'active' : '' ?>">
            <div class="item-icon-modern">
                <i class="fas fa-chart-bar"></i>
            </div>
            <span class="item-text-modern">Laporan</span>
        </a>
        <?php if (session()->get('role') === 'superadmin'): ?>
            <a href="<?= base_url('/superadmin/users') ?>" class="nav-item-modern <?= $active_menu === 'users' ? 'active' : '' ?>">
                <div class="item-icon-modern">
                    <i class="fas fa-users"></i>
                </div>
                <span class="item-text-modern">Users</span>
            </a>
        <?php endif; ?>
        <a href="<?= base_url('/admin/settings') ?>" class="nav-item-modern <?= $active_menu === 'settings' ? 'active' : '' ?>">
            <div class="item-icon-modern">
                <i class="fas fa-cog"></i>
            </div>
            <span class="item-text-modern">Settings</span>
        </a>
    </nav>
    <!-- Logout -->
    <div class="logout-section-modern">
        <a href="<?= base_url('/auth/logout') ?>" class="logout-btn-modern">
            <div class="item-icon-modern">
                <i class="fas fa-sign-out-alt"></i>
            </div>
            <span class="item-text-modern">Logout</span>
        </a>
    </div>
</div>