<script src="https://cdn.tailwindcss.com"></script>
<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<!-- Font Awesome CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<script>
    tailwind.config = {
        theme: {
            extend: {
                colors: {
                    bpjs: {
                        primary: '#1c5ca4',
                        secondary: '#2c343c', 
                        accent: '#e4943c',
                        light: '#93b0ca',
                        darkblue: '#0a1e3c'
                    }
                }
            }
        }
    }
</script>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
    
    body {
        font-family: 'Poppins', sans-serif;
    }
    
    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }
    
    .quick-action-btn:hover {
        transform: scale(1.05);
    }
</style>
<header class="fixed top-0 left-64 right-0 h-16 bg-white/95 backdrop-blur-lg z-40 flex items-center px-6 border-b border-gray-200/20 shadow-sm">
    <div class="flex items-center justify-between w-full">
        <div class="flex items-center space-x-2">
        <h1 class="text-xl font-semibold text-gray-800">Selamat datang,</h1>
        <span class="text-xl font-bold bg-gradient-to-r from-bpjs-primary to-bpjs-accent bg-clip-text text-transparent">
            <?= esc(session('username')) ?>
        </span>
    </div>

        
        <div class="flex items-center space-x-4">
            <div class="relative">
                <button class="p-2 rounded-full bg-gray-100 hover:bg-gray-200 transition">
                    <i class="fas fa-bell text-gray-600"></i>
                </button>
                <span class="absolute top-0 right-0 w-4 h-4 bg-red-500 rounded-full text-xs text-white flex items-center justify-center">3</span>
            </div>
            <div class="w-8 h-8 rounded-full bg-gradient-to-r from-bpjs-primary to-bpjs-accent flex items-center justify-center text-white font-semibold">
                A
            </div>
        </div>
    </div>
</header>
<aside class="w-64 h-screen fixed top-0 left-0 bg-gradient-to-b from-bpjs-primary to-bpjs-darkblue text-white flex flex-col shadow-2xl z-50">
    <!-- Brand Header -->
    <div class="p-6 pb-5 border-b border-blue-700/30">
        <div class="flex items-center gap-3">
            <!-- Logo -->
            <div class="flex-shrink-0">
                <div class="w-12 h-12 p-2 bg-white/10 backdrop-blur-sm rounded-xl border border-white/20 flex items-center justify-center">
                    <img src="<?= base_url('assets/images/loho.png') ?>" 
                         alt="Logo BPJS" 
                         class="w-8 h-8 object-contain">
                </div>
            </div>

            <!-- Text -->
            <div>
                <h1 class="text-lg font-bold leading-tight">
                    <span class="bg-gradient-to-r from-bpjs-accent to-[#FFD37A] bg-clip-text text-transparent">
                        BPJS
                    </span>
                </h1>
                <p class="text-xs font-medium text-blue-100 tracking-wide">
                    Ketenagakerjaan
                </p>
            </div>
        </div>
    </div>

    <!-- User Profile Mini -->
    <div class="px-4 py-3 border-b border-blue-700/30">
        <div class="flex items-center gap-3 p-2 rounded-lg bg-white/5 backdrop-blur-sm">
            <div class="w-8 h-8 rounded-full bg-gradient-to-r from-bpjs-accent to-orange-500 flex items-center justify-center text-white text-sm font-bold">
                <?= strtoupper(substr(session()->get('username') ?? 'A', 0, 1)) ?>
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-sm font-medium truncate"><?= session()->get('username') ?? 'Admin' ?></p>
                <p class="text-xs text-blue-200 capitalize"><?= session()->get('role') ?? 'admin' ?></p>
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="flex-1 px-3 py-4 space-y-1">
        <!-- Dashboard -->
         <a href="/admin/dashboard" 
            class="flex items-center gap-3 p-3 rounded-xl transition-all duration-200 group hover:bg-white/15 hover:border-white/20">

            <div class="p-2 rounded-lg bg-gradient-to-r from-bpjs-accent to-orange-500 shadow-lg">
                <i class="fas fa-tachometer-alt w-4 h-4 text-white"></i>
            </div>
            <span class="font-medium">Dashboard</span>
        </a>

        <!-- Jaminan -->
        <a href="/admin/jaminan" class="flex items-center gap-3 p-3 rounded-xl hover:bg-white/10 backdrop-blur-sm border border-transparent hover:border-white/10 transition-all duration-200 group">
            <div class="p-2 rounded-lg bg-blue-500/20 group-hover:bg-blue-500/30">
                <i class="fas fa-file-medical w-4 h-4 text-blue-300"></i>
            </div>
            <span>Jaminan</span>
        </a>

        <!-- BUBM -->
        <a href="/admin/bubm" class="flex items-center gap-3 p-3 rounded-xl hover:bg-white/10 backdrop-blur-sm border border-transparent hover:border-white/10 transition-all duration-200 group">
            <div class="p-2 rounded-lg bg-green-500/20 group-hover:bg-green-500/30">
                <i class="fas fa-money-check-alt w-4 h-4 text-green-300"></i>
            </div>
            <span>BUBM</span>
        </a>

        <!-- Settings -->
        <a href="/admin/settings" class="flex items-center gap-3 p-3 rounded-xl hover:bg-white/10 backdrop-blur-sm border border-transparent hover:border-white/10 transition-all duration-200 group">
            <div class="p-2 rounded-lg bg-purple-500/20 group-hover:bg-purple-500/30">
                <i class="fas fa-cog w-4 h-4 text-purple-300"></i>
            </div>
            <span>Pengaturan</span>
        </a>
       

        <!-- Superadmin Menu -->
        <?php if (session()->get('role') === 'superadmin') : ?>
             <!-- Separator Super Admin -->
            <div class="flex items-center my-4">
                <div class="flex-grow border-t border-white/20"></div>
                <span class="px-3 text-xs font-semibold uppercase text-blue-200 tracking-wider">
                    Khusus Menu Super Admin
                </span>
                <div class="flex-grow border-t border-white/20"></div>
            </div>
            <a href="/admin/list_user" 
            class="flex items-center gap-3 p-3 rounded-xl hover:bg-white/10 backdrop-blur-sm 
                    border border-transparent hover:border-white/10 transition-all duration-200 group">
                <div class="p-2 rounded-lg bg-amber-500/20 group-hover:bg-amber-500/30">
                    <i class="fas fa-user-plus w-4 h-4 text-amber-300"></i>
                </div>
                <span>Kelola Akun</span>
            </a>
        <?php endif; ?>

    </nav>

   

    <!-- Logout -->
    <div class="px-3 py-4 border-t border-blue-700/30">
        <a href="/logout" class="flex items-center gap-3 p-3 rounded-xl hover:bg-red-500/20 backdrop-blur-sm border border-transparent hover:border-red-400/30 transition-all duration-200 group">
            <div class="p-2 rounded-lg bg-red-500/20 group-hover:bg-red-500/30">
                <i class="fas fa-sign-out-alt w-4 h-4 text-red-300 group-hover:text-red-200"></i>
            </div>
            <span class="text-red-300 group-hover:text-red-200">Logout</span>
        </a>
    </div>

    <!-- Version -->
    <div class="px-4 py-3 border-t border-blue-700/30">
        <div class="text-center">
            <p class="text-xs text-blue-300">v2.1.0 • BPJS Ketenagakerjaan</p>
        </div>
    </div>
</aside>

<style>
    /* Smooth transitions for all interactive elements */
    aside a {
        transition: all 0.3s ease;
    }
    
    /* Hover effects */
    aside a:hover {
        transform: translateX(5px);
    }
    
    /* Active link indicator */
    aside a.active {
        background: linear-gradient(90deg, rgba(255, 255, 255, 0.15) 0%, rgba(255, 255, 255, 0.05) 100%);
        border-left: 3px solid #e4943c;
    }
    
    /* Glassmorphism effect */
    .backdrop-blur-sm {
        backdrop-filter: blur(8px);
        -webkit-backdrop-filter: blur(8px);
    }
    
    /* Pulse animation for active status */
    @keyframes pulse {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.5; }
    }
    
    .animate-pulse {
        animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
    }
    
    /* Custom scrollbar for sidebar */
    nav {
        scrollbar-width: thin;
        scrollbar-color: rgba(255, 255, 255, 0.2) transparent;
    }
    
    nav::-webkit-scrollbar {
        width: 4px;
    }
    
    nav::-webkit-scrollbar-track {
        background: transparent;
    }
    
    nav::-webkit-scrollbar-thumb {
        background: rgba(255, 255, 255, 0.2);
        border-radius: 2px;
    }
    
    nav::-webkit-scrollbar-thumb:hover {
        background: rgba(255, 255, 255, 0.3);
    }
</style>

<script>
    // Add active class to current page link
    document.addEventListener('DOMContentLoaded', function() {
        const currentPath = window.location.pathname;
        const navLinks = document.querySelectorAll('nav a');
        
        navLinks.forEach(link => {
            if (link.getAttribute('href') === currentPath) {
                link.classList.add('active');
            }
        });
        
        // Add click animation
        navLinks.forEach(link => {
            link.addEventListener('click', function() {
                this.style.transform = 'translateX(8px)';
                setTimeout(() => {
                    this.style.transform = 'translateX(0)';
                }, 300);
            });
        });
    });
</script>