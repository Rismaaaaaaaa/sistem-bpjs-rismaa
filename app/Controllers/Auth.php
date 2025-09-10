<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        // Inisialisasi model di constructor
        $this->userModel = new UserModel();
    }

    public function login()
    {
        // Kalau udah login, langsung redirect sesuai role
        if (session()->get('logged_in')) {
            return $this->redirectByRole(session()->get('role'));
        }

        return view('auth/login');
    }

    public function auth()
    {
        // Rules validasi
        $validationRules = [
            'email'    => 'required|valid_email',
            'password' => 'required|min_length[6]',
        ];

        // Jalankan validasi
        if (!$this->validate($validationRules)) {
            return redirect()->back()
                ->withInput()
                ->with('error', implode('<br>', $this->validator->getErrors()));
        }

        // Ambil data dari form
        $email    = $this->request->getPost('email', FILTER_SANITIZE_EMAIL);
        $password = $this->request->getPost('password');

        // Cari user berdasarkan email
        $user = $this->userModel->where('email', $email)->first();

        if ($user && password_verify($password, $user['password'])) {
            // Regenerate session ID biar lebih aman
            session()->regenerate();

            // Simpan data ke session
            session()->set([
                'user_id'   => $user['id'],
                'username'  => $user['username'],
                'role'      => $user['role'],
                'logged_in' => true,
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
     * Helper redirect berdasarkan role user
     */
    private function redirectByRole($role)
    {
        switch ($role) {
            case 'admin':
                return redirect()->to('/admin/dashboard');
            case 'superadmin':
                return redirect()->to('/super/dashboard');
            default:
                session()->destroy();
                return redirect()->to('/login')->with('error', 'Role tidak dikenali.');
        }
    }
}
