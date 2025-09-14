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
        $userModel = new \App\Models\UserModel();

        $identity = $this->request->getPost('email'); // bisa email / username
        $password = $this->request->getPost('password');

        // Prioritas cek email dulu
        $user = $userModel->where('email', $identity)->first();

        // Kalau ga ketemu dengan email, cek username
        if (!$user) {
            $user = $userModel->where('username', $identity)->first();
        }

        if ($user && password_verify($password, $user['password'])) {
            // ✅ Simpan session
            session()->set([
                'isLoggedIn' => true,
                'user_id'    => $user['id'],
                'username'   => $user['username'],
                'email'      => $user['email'],
                'role'       => $user['role'],
            ]);

            return redirect()->to('/dashboard')
                            ->with('success', 'Selamat datang, ' . $user['username']);
        }

        return redirect()->back()->with('error', 'Email/Username atau password salah');
    }



    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login')->with('success', 'Berhasil logout.');
    }
    

    /**
     * Helper redirect berdasarkan role user
     */
    /**
 * Helper redirect berdasarkan role user
 */
    private function redirectByRole($role)
    {
        switch ($role) {
            case 'admin':
            case 'superadmin': // superadmin tetap diarahkan ke admin
                return redirect()->to('/admin/dashboard');
            default:
                session()->destroy();
                return redirect()->to('/login')->with('error', 'Role tidak dikenali.');
        }
    }

}
