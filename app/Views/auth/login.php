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
        .input-focus-effect {
            transition: all 0.3s ease;
        }
        .input-focus-effect:focus {
            box-shadow: 0 5px 15px rgba(228, 148, 60, 0.2);
            transform: translateY(-2px);
        }
        .password-toggle {
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
        }
        .logo-container {
            background: linear-gradient(135deg, rgba(255,255,255,0.9) 0%, rgba(255,255,255,0.8) 100%);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.5);
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

    <div class="relative min-h-screen flex items-center justify-center p-8">
        <div class="bg-white/10 backdrop-blur-xl rounded-3xl shadow-2xl border border-white/20 p-8 w-full max-w-md transform transition-all duration-300 hover:scale-[1.02]">
            
            <!-- Header -->
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-60 h-24 bg-white/20 rounded-3xl backdrop-blur-sm p-3 mb-4">
                    <img src="<?= base_url('assets/images/logo-bpjs-well.png') ?>" alt="Logo BPJS" class="w-60 h-12 object-contain">
                </div>
                <h1 class="text-3xl font-bold text-white my-2">SISTEM ARSIP BPJS</h1>
                <p class="text-bpjs-light text-sm">Nikmati kemudahan mengelola program BPJS Ketenagakerjaan secara digital</p>

            </div>

            <!-- Alert Message -->
            <?php if(session()->getFlashdata('error')): ?>
                <div class="mb-4 p-4 bg-red-500/90 text-white text-sm rounded-xl shadow-lg flex items-start">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span><?= session()->getFlashdata('error'); ?></span>
                </div>
            <?php endif; ?>
            
            <?php if(session()->getFlashdata('success')): ?>
                <div class="mb-4 p-4 bg-green-500/90 text-white text-sm rounded-xl shadow-lg flex items-start">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span><?= session()->getFlashdata('success'); ?></span>
                </div>
            <?php endif; ?>

            <!-- Login Form -->
            <form method="post" action="<?= base_url('/auth') ?>" class="space-y-6">
                <!-- Email -->
              <div class="space-y-2">
                <label class="block text-white/90 text-sm font-medium mb-2 ml-1" for="identity">
                    Email atau Username
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-bpjs-primary" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                        </svg>
                    </div>
                    <input 
                        type="text" 
                        id="identity" 
                        name="email" 
                        placeholder="Masukkan email atau username" 
                        required
                        class="w-full pl-12 pr-4 py-4 bg-white/95 rounded-xl border-2 border-white/40 
                            focus:border-bpjs-accent focus:ring-4 focus:ring-bpjs-accent/20 
                            transition-all duration-200 placeholder-gray-500 text-gray-800 
                            font-medium input-focus-effect">
                </div>
            </div>


                <!-- Password -->
                <div class="space-y-2">
                    <label class="block text-white/90 text-sm font-medium mb-2 ml-1" for="password">Kata Sandi</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-bpjs-primary" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <input type="password" id="password" name="password" placeholder="Masukkan kata sandi" required
                            class="w-full pl-12 pr-12 py-4 bg-white/95 rounded-xl border-2 border-white/40 focus:border-bpjs-accent focus:ring-4 focus:ring-bpjs-accent/20 transition-all duration-200 placeholder-gray-500 text-gray-800 font-medium input-focus-effect">
                        <div class="password-toggle absolute" onclick="togglePassword()">
                            <svg id="eye-icon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Remember & Forgot -->
                <div class="flex items-center justify-between pt-2">
                    <label class="flex items-center">
                        <div class="relative flex items-center">
                            <input type="checkbox" class="sr-only" id="remember">
                            <div class="w-4 h-4 bg-white/90 rounded-sm border border-gray-300 flex items-center justify-center check-container">
                                <svg class="w-3 h-3 text-bpjs-accent hidden check-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                        </div>
                        <span class="ml-2 text-sm text-white/90">Ingat saya</span>
                    </label>
                </div>

                <!-- Submit -->
                <button type="submit" class="w-full bg-gradient-to-r from-bpjs-accent to-orange-500 hover:from-orange-500 hover:to-bpjs-accent text-white font-bold py-4 px-6 rounded-xl transition-all duration-300 transform hover:scale-[1.02] focus:outline-none focus:ring-4 focus:ring-orange-400/50 shadow-lg hover:shadow-orange-500/30 group">
                    <span class="flex items-center justify-center">
                        <svg class="w-5 h-5 mr-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                        </svg>
                        MASUK AKUN
                    </span>
                </button>
            </form>

            <!-- Additional Info -->
            <div class="mt-6 p-4 bg-white/10 rounded-xl border border-white/10">
                <p class="text-white/80 text-xs flex items-start">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Pastikan Anda menggunakan email dan kata sandi yang telah terdaftar pada sistem. Hubungi administrator jika mengalami kendala.
                </p>
            </div>

            <!-- Footer -->
            <div class="text-center mt-8 pt-6 border-t border-white/10">
                <p class="text-bpjs-light text-xs">© 2025 BPJS Ketenagakerjaan. Hak Cipta Dilindungi.</p>
                <p class="text-bpjs-light/80 text-xs mt-1">Alarm module is a smart keynote installation digital sites!</p>
            </div>
        </div>
    </div>

    <script>
        // Toggle password visibility
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eye-icon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />';
            } else {
                passwordInput.type = 'password';
                eyeIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />';
            }
        }

        // Custom checkbox functionality
        document.getElementById('remember').addEventListener('change', function() {
            const checkIcon = document.querySelector('.check-icon');
            if (this.checked) {
                checkIcon.classList.remove('hidden');
            } else {
                checkIcon.classList.add('hidden');
            }
        });
    </script>
</body>
</html>