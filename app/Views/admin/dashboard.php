<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard BPJS</title>
    <!-- Tailwind CSS CDN -->
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
</head>
<body class="bg-gray-50">
    <!-- Modern Header -->
    <header class="fixed top-0 left-64 right-0 h-16 bg-white/95 backdrop-blur-lg z-40 flex items-center px-6 border-b border-gray-200/20 shadow-sm">
        <div class="flex items-center justify-between w-full">
            <div class="flex items-center space-x-2">
                <h1 class="text-xl font-semibold text-gray-800">Selamat datang,</h1>
                <span class="text-xl font-bold bg-gradient-to-r from-bpjs-primary to-bpjs-accent bg-clip-text text-transparent">
                    Admin BPJS
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

    <!-- Sidebar -->
    <aside class="w-64 h-screen fixed top-0 left-0 bg-gradient-to-b from-bpjs-primary to-bpjs-darkblue text-white flex flex-col shadow-xl z-50">
        <!-- Brand Header -->
        <div class="p-5 pb-4 border-b border-blue-700/30">
            <div class="text-2xl font-bold tracking-tight">
                <span class="bg-gradient-to-r from-bpjs-accent to-[#FFD37A] bg-clip-text text-transparent">BPJS</span>
                <div class="text-sm font-medium text-gray-300 mt-1">Healthcare Administration</div>
            </div>
        </div>

        <!-- Navigation -->
        <nav class="flex-1 px-3 py-4 space-y-1">
            <a href="/admin/dashboard" class="flex items-center gap-3 p-3 rounded-xl bg-[#145188]/80 transition group">
                <div class="p-1.5 rounded-lg bg-bpjs-accent/20">
                    <i class="fas fa-tachometer-alt w-4 h-4 text-bpjs-accent"></i>
                </div>
                <span>Dashboard</span>
            </a>
            <a href="/admin/jaminan" class="flex items-center gap-3 p-3 rounded-xl hover:bg-[#145188]/80 transition group">
                <div class="p-1.5 rounded-lg bg-bpjs-accent/10 group-hover:bg-bpjs-accent/20">
                    <i class="fas fa-file-medical w-4 h-4 text-bpjs-accent"></i>
                </div>
                <span>Jaminan</span>
            </a>
            <a href="/admin/bubm" class="flex items-center gap-3 p-3 rounded-xl hover:bg-[#145188]/80 transition group">
                <div class="p-1.5 rounded-lg bg-bpjs-accent/10 group-hover:bg-bpjs-accent/20">
                    <i class="fas fa-money-check-alt w-4 h-4 text-bpjs-accent"></i>
                </div>
                <span>BUBM</span>
            </a>
            <a href="/admin/peserta" class="flex items-center gap-3 p-3 rounded-xl hover:bg-[#145188]/80 transition group">
                <div class="p-1.5 rounded-lg bg-bpjs-accent/10 group-hover:bg-bpjs-accent/20">
                    <i class="fas fa-users w-4 h-4 text-bpjs-accent"></i>
                </div>
                <span>Data Peserta</span>
            </a>
            <a href="/admin/laporan" class="flex items-center gap-3 p-3 rounded-xl hover:bg-[#145188]/80 transition group">
                <div class="p-1.5 rounded-lg bg-bpjs-accent/10 group-hover:bg-bpjs-accent/20">
                    <i class="fas fa-chart-bar w-4 h-4 text-bpjs-accent"></i>
                </div>
                <span>Laporan</span>
            </a>
        </nav>

        <!-- Logout -->
        <div class="px-3 py-4 border-t border-blue-700/30">
            <a href="/logout" class="flex items-center gap-3 p-3 rounded-xl hover:bg-red-600/90 transition group">
                <div class="p-1.5 rounded-lg bg-red-500/10 group-hover:bg-red-500/20">
                    <i class="fas fa-sign-out-alt w-4 h-4 text-red-300 group-hover:text-white"></i>
                </div>
                <span class="text-red-300 group-hover:text-white">Logout</span>
            </a>
        </div>
    </aside>

    <!-- Main Content Area -->
    <main class="ml-64 pt-16 min-h-screen p-6">
        <!-- Statistik Ringkas -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
            <!-- Total Input Jaminan -->
            <div class="bg-white rounded-xl shadow-sm p-5 stat-card transition duration-300">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-sm text-gray-500">Total Input Jaminan</p>
                        <h3 class="text-2xl font-bold text-gray-800 mt-1">1,248</h3>
                        <p class="text-xs text-green-500 mt-1"><i class="fas fa-arrow-up mr-1"></i> 12% dari bulan lalu</p>
                    </div>
                    <div class="bg-blue-100 p-3 rounded-lg">
                        <i class="fas fa-file-medical text-blue-600 text-xl"></i>
                    </div>
                </div>
            </div>
            
            <!-- Total Input BUBM -->
            <div class="bg-white rounded-xl shadow-sm p-5 stat-card transition duration-300">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-sm text-gray-500">Total Input BUBM</p>
                        <h3 class="text-2xl font-bold text-gray-800 mt-1">892</h3>
                        <p class="text-xs text-green-500 mt-1"><i class="fas fa-arrow-up mr-1"></i> 8% dari bulan lalu</p>
                    </div>
                    <div class="bg-orange-100 p-3 rounded-lg">
                        <i class="fas fa-money-check-alt text-orange-600 text-xl"></i>
                    </div>
                </div>
            </div>
            
            <!-- Jumlah Peserta -->
            <div class="bg-white rounded-xl shadow-sm p-5 stat-card transition duration-300">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-sm text-gray-500">Jumlah Peserta</p>
                        <h3 class="text-2xl font-bold text-gray-800 mt-1">24,589</h3>
                        <p class="text-xs text-green-500 mt-1"><i class="fas fa-arrow-up mr-1"></i> 5% dari bulan lalu</p>
                    </div>
                    <div class="bg-green-100 p-3 rounded-lg">
                        <i class="fas fa-users text-green-600 text-xl"></i>
                    </div>
                </div>
            </div>
            
            <!-- Laporan Dibuat -->
            <div class="bg-white rounded-xl shadow-sm p-5 stat-card transition duration-300">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-sm text-gray-500">Laporan Dibuat</p>
                        <h3 class="text-2xl font-bold text-gray-800 mt-1">42</h3>
                        <p class="text-xs text-red-500 mt-1"><i class="fas fa-arrow-down mr-1"></i> 3% dari bulan lalu</p>
                    </div>
                    <div class="bg-purple-100 p-3 rounded-lg">
                        <i class="fas fa-chart-bar text-purple-600 text-xl"></i>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Grafik dan Quick Actions -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
            <!-- Grafik Trend -->
            <div class="lg:col-span-2 bg-white rounded-xl shadow-sm p-5">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Trend Input Jaminan & BUBM</h3>
                <canvas id="trendChart" height="250"></canvas>
            </div>
            
            <!-- Quick Actions -->
            <div class="bg-white rounded-xl shadow-sm p-5">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Quick Actions</h3>
                <div class="space-y-3">
                    <a href="#" class="quick-action-btn flex items-center p-3 bg-blue-50 rounded-lg hover:bg-blue-100 transition duration-300">
                        <div class="bg-blue-100 p-2 rounded-lg mr-3">
                            <i class="fas fa-plus text-blue-600"></i>
                        </div>
                        <span class="text-blue-700 font-medium">Tambah Jaminan</span>
                    </a>
                    <a href="#" class="quick-action-btn flex items-center p-3 bg-orange-50 rounded-lg hover:bg-orange-100 transition duration-300">
                        <div class="bg-orange-100 p-2 rounded-lg mr-3">
                            <i class="fas fa-plus text-orange-600"></i>
                        </div>
                        <span class="text-orange-700 font-medium">Tambah BUBM</span>
                    </a>
                    <a href="#" class="quick-action-btn flex items-center p-3 bg-purple-50 rounded-lg hover:bg-purple-100 transition duration-300">
                        <div class="bg-purple-100 p-2 rounded-lg mr-3">
                            <i class="fas fa-file-export text-purple-600"></i>
                        </div>
                        <span class="text-purple-700 font-medium">Generate Laporan</span>
                    </a>
                    <a href="#" class="quick-action-btn flex items-center p-3 bg-green-50 rounded-lg hover:bg-green-100 transition duration-300">
                        <div class="bg-green-100 p-2 rounded-lg mr-3">
                            <i class="fas fa-user-plus text-green-600"></i>
                        </div>
                        <span class="text-green-700 font-medium">Tambah Peserta</span>
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Pie Chart dan Recent Activity -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
            <!-- Pie Chart -->
            <div class="bg-white rounded-xl shadow-sm p-5">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Distribusi Status Jaminan</h3>
                <canvas id="statusChart" height="250"></canvas>
            </div>
            
            <!-- Recent Activity -->
            <div class="lg:col-span-2 bg-white rounded-xl shadow-sm p-5">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Aktivitas Terbaru</h3>
                <div class="space-y-4">
                    <div class="flex items-start">
                        <div class="bg-blue-100 p-2 rounded-lg mr-3">
                            <i class="fas fa-file-medical text-blue-600"></i>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-medium">Jaminan baru ditambahkan</p>
                            <p class="text-xs text-gray-500">Jaminan untuk Ahmad Rizki (No. Peserta: 1234567890) telah ditambahkan</p>
                            <p class="text-xs text-gray-400 mt-1">2 jam yang lalu</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start">
                        <div class="bg-green-100 p-2 rounded-lg mr-3">
                            <i class="fas fa-check-circle text-green-600"></i>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-medium">BUBM disetujui</p>
                            <p class="text-xs text-gray-500">BUBM untuk Siti Rahayu (No. Klaim: BUBM-2023-0872) telah disetujui</p>
                            <p class="text-xs text-gray-400 mt-1">5 jam yang lalu</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start">
                        <div class="bg-purple-100 p-2 rounded-lg mr-3">
                            <i class="fas fa-chart-bar text-purple-600"></i>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-medium">Laporan dibuat</p>
                            <p class="text-xs text-gray-500">Laporan bulanan Oktober 2023 telah berhasil digenerate</p>
                            <p class="text-xs text-gray-400 mt-1">Kemarin, 15:42</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start">
                        <div class="bg-amber-100 p-2 rounded-lg mr-3">
                            <i class="fas fa-user text-amber-600"></i>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-medium">Admin login</p>
                            <p class="text-xs text-gray-500">Admin terakhir login: Budi Santoso (08:45)</p>
                            <p class="text-xs text-gray-400 mt-1">Hari ini, 08:45</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Notifikasi / Reminder -->
        <div class="bg-white rounded-xl shadow-sm p-5 mb-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Notifikasi & Pengingat</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 rounded-r">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <i class="fas fa-exclamation-circle text-yellow-400"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-yellow-700">
                                <span class="font-medium">Peringatan!</span> 15 data jaminan membutuhkan persetujuan segera.
                            </p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-blue-50 border-l-4 border-blue-400 p-4 rounded-r">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <i class="fas fa-info-circle text-blue-400"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-blue-700">
                                <span class="font-medium">Info!</span> Laporan bulanan harus dikirim sebelum 5 November 2023.
                            </p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-red-50 border-l-4 border-red-400 p-4 rounded-r">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <i class="fas fa-times-circle text-red-400"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-red-700">
                                <span class="font-medium">Penting!</span> 7 data BUBM ditolak dan memerlukan revisi.
                            </p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-green-50 border-l-4 border-green-400 p-4 rounded-r">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <i class="fas fa-check-circle text-green-400"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-green-700">
                                <span class="font-medium">Selamat!</span> 98% klaim berhasil diproses bulan ini.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        // Trend Chart (Grafik Batang)
        const trendCtx = document.getElementById('trendChart').getContext('2d');
        const trendChart = new Chart(trendCtx, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt'],
                datasets: [
                    {
                        label: 'Input Jaminan',
                        data: [120, 150, 180, 90, 130, 160, 190, 110, 140, 170],
                        backgroundColor: '#1c5ca4',
                        borderColor: '#1c5ca4',
                        borderWidth: 1
                    },
                    {
                        label: 'Input BUBM',
                        data: [80, 110, 70, 100, 130, 90, 120, 80, 110, 140],
                        backgroundColor: '#e4943c',
                        borderColor: '#e4943c',
                        borderWidth: 1
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
        
        // Status Chart (Pie Chart)
        const statusCtx = document.getElementById('statusChart').getContext('2d');
        const statusChart = new Chart(statusCtx, {
            type: 'pie',
            data: {
                labels: ['Disetujui', 'Pending', 'Ditolak'],
                datasets: [{
                    data: [65, 25, 10],
                    backgroundColor: [
                        '#10B981',
                        '#F59E0B',
                        '#EF4444'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    }
                }
            }
        });
    </script>
</body>
</html>