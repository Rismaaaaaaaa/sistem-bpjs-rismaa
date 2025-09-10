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