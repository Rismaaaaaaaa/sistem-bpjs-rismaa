<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        // Inisialisasi model di constructor biar reusable
        $this->userModel = new UserModel();
    }

    public function login()
    {
        // Cek kalau udah login, redirect sesuai role
        if (session()->get('logged_in')) {
            return $this->redirectByRole(session()->get('role'));
        }

        return view('auth/login');
    }

    public function auth()
    {
        // Validasi input
        $validationRules = [
            'email'    => 'required|valid_email',
            'password' => 'required|min_length[6]' // Minimal 6 karakter, sesuaikan kebutuhan
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Email atau password tidak valid.');
        }

        // Ambil data dari form
        $email = $this->request->getVar('email', FILTER_SANITIZE_EMAIL);
        $password = $this->request->getVar('password');

        // Cari user berdasarkan email
        $user = $this->userModel->where('email', $email)->first();

        // Cek user ada dan password cocok
        if ($user && password_verify($password, $user['password'])) {
            // Regenerate session untuk keamanan
            session()->regenerate();

            // Set session data
            session()->set([
                'user_id'   => $user['id'],
                'username'  => $user['username'],
                'role'      => $user['role'],
                'logged_in' => true
            ]);

            // Redirect berdasarkan role
            return $this->redirectByRole($user['role']);
        }

        // Kalau gagal login
        return redirect()->back()
            ->withInput()
            ->with('error', 'Email atau password salah.');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login')->with('success', 'Berhasil logout.');
    }

    /**
     * Helper method untuk redirect berdasarkan role
     */
    private function redirectByRole($role)
    {
        $routes = [
            'admin'      => '/admin/dashboard',
            'superadmin' => '/superadmin/dashboard'
        ];

        // Cek kalau role valid
        if (array_key_exists($role, $routes)) {
            return redirect()->to($routes[$role]);
        }

        // Kalau role ga dikenali, logout dan kasih error
        session()->destroy();
        return redirect()->to('/login')->with('error', 'Role tidak dikenali.');
    }
}