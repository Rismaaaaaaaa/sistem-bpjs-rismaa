<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Superadmin Dashboard</title>
    <style>
        body { font-family: Arial, sans-serif; background: #fef6e4; }
        .container { max-width: 800px; margin: 50px auto; background: white; padding: 30px; border-radius: 10px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
        h1 { color: #d35400; }
        .info { margin-top: 20px; padding: 15px; background: #fdebd0; border-radius: 8px; }
        a { display: inline-block; margin-top: 20px; padding: 10px 20px; background: #e67e22; color: white; text-decoration: none; border-radius: 5px; }
        a:hover { background: #ca6f1e; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Superadmin Dashboard</h1>
        <p>Selamat datang, <b><?= session()->get('username'); ?></b>!</p>
        <div class="info">
            <p>Role: <b><?= session()->get('role'); ?></b></p>
            <p>Halaman ini khusus untuk <b>Superadmin</b>.</p>
        </div>
        <a href="<?= base_url('/logout'); ?>">Logout</a>
    </div>
</body>
</html>
