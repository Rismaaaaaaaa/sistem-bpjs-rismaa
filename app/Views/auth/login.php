<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Sistem BPJS</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
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
                            purple: '#ae8ee6'
                        }
                    },
                    animation: {
                        'gradient': 'gradient 15s ease infinite',
                        'float': 'float 6s ease-in-out infinite',
                    },
                    keyframes: {
                        gradient: {
                            '0%, 100%': {
                                'background-size': '200% 200%',
                                'background-position': 'left center'
                            },
                            '50%': {
                                'background-size': '200% 200%',
                                'background-position': 'right center'
                            }
                        },
                        float: {
                            '0%, 100%': { transform: 'translateY(0px)' },
                            '50%': { transform: 'translateY(-20px)' }
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
    </style>
</head>
<body class="min-h-screen bg-gradient-to-br from-blue-900 via-bpjs-primary to-purple-900 animate-gradient bg-200%">

    <!-- Animated Background -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-20 left-10 w-72 h-72 bg-bpjs-accent/20 rounded-full blur-3xl animate-float"></div>
        <div class="absolute top-60 right-20 w-96 h-96 bg-bpjs-purple/20 rounded-full blur-3xl animate-float" style="animation-delay: 2s;"></div>
        <div class="absolute bottom-20 left-1/4 w-80 h-80 bg-blue-400/20 rounded-full blur-3xl animate-float" style="animation-delay: 4s;"></div>
    </div>

    <div class="relative min-h-screen flex items-center justify-center p-4">
        <div class="bg-white/10 backdrop-blur-xl rounded-3xl shadow-2xl border border-white/20 p-8 w-full max-w-md transform transition-all duration-300 hover:scale-105">
            
            <!-- Header -->
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-white/20 rounded-2xl backdrop-blur-sm p-3 mb-4">
                    <svg class="w-12 h-12 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2L2 7l10 5 10-5-10-5zm0 2.5L20 7l-8 4-8-4 8-4.5z"/>
                        <path d="M2 17l10 5 10-5"/>
                        <path d="M2 12l10 5 10-5"/>
                    </svg>
                </div>
                <h1 class="text-3xl font-bold text-white mb-2">SISTEM DATA BPJS</h1>
                <p class="text-bpjs-light text-sm">Akses mudah dan aman ke layanan kesehatan digital</p>
            </div>

            <!-- Alert Message -->
            <?php if(session()->getFlashdata('error')): ?>
                <div class="mb-4 p-3 bg-red-500 text-white text-sm rounded-lg shadow">
                    <?= session()->getFlashdata('error'); ?>
                </div>
            <?php endif; ?>
            
            <?php if(session()->getFlashdata('success')): ?>
                <div class="mb-4 p-3 bg-green-500 text-white text-sm rounded-lg shadow">
                    <?= session()->getFlashdata('success'); ?>
                </div>
            <?php endif; ?>

            <!-- Login Form -->
            <form method="post" action="<?= base_url('/auth') ?>" class="space-y-6">
                <!-- Email -->
                <div class="space-y-2">
                    <label class="block text-white/80 text-sm font-medium mb-2" for="email">Email</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                            </svg>
                        </div>
                        <input type="email" id="email" name="email" placeholder="Masukkan email Anda" required
                            class="w-full pl-10 px-4 py-4 bg-white/95 rounded-xl border-2 border-white/30 focus:border-bpjs-accent focus:ring-4 focus:ring-bpjs-accent/30 transition-all duration-200 placeholder-gray-500 text-gray-800 font-medium">
                    </div>
                </div>

                <!-- Password -->
                <div class="space-y-2">
                    <label class="block text-white/80 text-sm font-medium mb-2" for="password">Password</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <input type="password" id="password" name="password" placeholder="Masukkan password Anda" required
                            class="w-full pl-10 px-4 py-4 bg-white/95 rounded-xl border-2 border-white/30 focus:border-bpjs-accent focus:ring-4 focus:ring-bpjs-accent/30 transition-all duration-200 placeholder-gray-500 text-gray-800 font-medium">
                    </div>
                </div>

                <!-- Remember & Forgot -->
                <div class="flex items-center justify-between">
                    <label class="flex items-center">
                        <input type="checkbox" class="w-4 h-4 text-bpjs-accent bg-white/90 border-gray-300 rounded focus:ring-bpjs-accent">
                        <span class="ml-2 text-sm text-white/80">Ingat saya</span>
                    </label>
                    <a href="#" class="text-sm text-bpjs-light hover:text-white transition-colors duration-200">Lupa password?</a>
                </div>

                <!-- Submit -->
                <button type="submit" class="w-full bg-gradient-to-r from-bpjs-accent to-orange-500 hover:from-orange-500 hover:to-bpjs-accent text-white font-bold py-4 px-6 rounded-xl transition-all duration-300 transform hover:scale-105 focus:outline-none focus:ring-4 focus:ring-orange-400/50 shadow-lg hover:shadow-orange-500/30">
                    <span class="flex items-center justify-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                        </svg>
                        MASUK AKUN
                    </span>
                </button>
            </form>

            <!-- Footer -->
            <div class="text-center mt-8">
                <p class="text-bpjs-light text-sm">© 2025 BPJS Kesehatan. Hak Cipta Dilindungi.</p>
            </div>
        </div>
    </div>
</body>
</html>
