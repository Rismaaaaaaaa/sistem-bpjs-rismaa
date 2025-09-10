<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? $title : 'BPJS Admin' ?></title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome 6 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
        }
        .sidenav {
            height: 100vh;
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #2c3e50;
            padding-top: 20px;
            transition: all 0.3s;
        }
        .sidenav .nav-link {
            color: #ffffff;
            padding: 10px 15px;
            font-size: 1.1rem;
            border-radius: 5px;
            margin: 5px 10px;
            transition: all 0.3s;
        }
        .sidenav .nav-link:hover,
        .sidenav .nav-link.active {
            background-color: #3498db;
            color: #ffffff;
        }
        .sidenav .nav-link i {
            margin-right: 10px;
        }
        .sidenav .brand {
            color: #ffffff;
            font-size: 1.5rem;
            font-weight: bold;
            text-align: center;
            margin-bottom: 20px;
        }
        .content {
            margin-left: 250px;
            padding: 20px;
        }
        .navbar-toggler {
            display: none;
        }
        @media (max-width: 768px) {
            .sidenav {
                width: 0;
                overflow: hidden;
            }
            .sidenav.active {
                width: 250px;
            }
            .content {
                margin-left: 0;
            }
            .navbar-toggler {
                display: block;
                position: fixed;
                top: 10px;
                left: 10px;
                z-index: 1000;
            }
        }
    </style>
</head>
<body>
    <!-- Sidenav -->
    <?= $this->include('layouts/sidenav') ?>

    <!-- Toggle Button for Mobile -->
    <button class="navbar-toggler btn btn-primary" type="button" onclick="toggleSidenav()">
        <i class="fas fa-bars"></i>
    </button>

    <!-- Content Area -->
    <div class="content">
        <?= $this->renderSection('content') ?>
    </div>

    <!-- Bootstrap JS and Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function toggleSidenav() {
            const sidenav = document.getElementById('sidenav');
            sidenav.classList.toggle('active');
        }
    </script>
</body>
</html>