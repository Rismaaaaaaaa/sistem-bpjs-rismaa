<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f0f4f7; }
        .container { max-width: 800px; margin: 50px auto; background: white; padding: 30px; border-radius: 10px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
        h1 { color: #2c3e50; }
        .info { margin-top: 20px; padding: 15px; background: #ecf0f1; border-radius: 8px; }
        a { display: inline-block; margin-top: 20px; padding: 10px 20px; background: #e74c3c; color: white; text-decoration: none; border-radius: 5px; }
        a:hover { background: #c0392b; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Admin Dashboard</h1>
        <p>Selamat datang, <b><?= session()->get('username'); ?></b>!</p>
        <div class="info">
            <p>Role: <b><?= session()->get('role'); ?></b></p>
            <p>Halaman ini khusus untuk <b>Admin</b>.</p>
        </div>
        <a href="<?= base_url('/logout'); ?>">Logout</a>
    </div>
</body>
</html>
