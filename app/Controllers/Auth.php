<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function register()
    {
        return view('auth/register');
    }

    public function store()
    {
        $userModel = new UserModel();
        $data = [
            'username' => $this->request->getVar('username'),
            'email'    => $this->request->getVar('email'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            'role'     => $this->request->getVar('role') ?? 'admin',
        ];
        $userModel->save($data);
        return redirect()->to('/login')->with('success', 'Register success!');
    }

    public function login()
    {
        return view('auth/login');
    }

    public function auth()
    {
        $userModel = new UserModel();
        $user = $userModel->where('email', $this->request->getVar('email'))->first();

        if ($user && password_verify($this->request->getVar('password'), $user['password'])) {
            session()->set([
                'user_id' => $user['id'],
                'username'=> $user['username'],
                'role'    => $user['role'],
                'logged_in' => true
            ]);

            if ($user['role'] === 'superadmin') {
                return redirect()->to('/superadmin/dashboard');
            }
            return redirect()->to('/admin/dashboard');
        }

        return redirect()->back()->with('error', 'Email atau Password salah');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
