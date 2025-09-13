<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? $title : 'BPJS Admin' ?></title>
    <!-- Font Awesome 6 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
    function showNoFileToast() {
        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: 'warning',
            title: 'Dokumen tidak tersedia',
            showConfirmButton: false,
            timer: 2000,
            timerProgressBar: true
        });
    }
    </script>



    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>

    <!-- Custom Colors BPJS -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'bpjs-primary': '#2c3e50',
                        'bpjs-accent': '#3498db'
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-50 font-sans">
    <!-- Sidenav -->
    <?= $this->include('layouts/sideContoh') ?>

    <!-- Content -->
    <div class="ml-64 p-6 transition-all duration-300" id="content">
        <?= $this->renderSection('content') ?>
    </div>

    <!-- Script Lucide -->
    <script>
        lucide.createIcons();

        // Toggle sidenav buat mobile
        function toggleSidenav() {
            const sidenav = document.getElementById('sidenav');
            const content = document.getElementById('content');
            sidenav.classList.toggle('-translate-x-full');
            content.classList.toggle('ml-0');
        }
    </script>
</body>
</html>
