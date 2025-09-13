<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class SettingsController extends Controller
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        helper(['form', 'url']);
    }

    public function index()
    {
        // Misalnya ambil user yang sedang login
        $session = session();
        $userId = $session->get('id'); // Pastikan waktu login diset ID user

        $user = $this->userModel->find($userId);

        return view('admin/settings', ['user' => $user]);
    }

    public function update()
    {
        $session = session();
        $userId = $session->get('id');

        $data = [
            'username'      => $this->request->getPost('username'),
            'email'         => $this->request->getPost('email'),
            'alamat'        => $this->request->getPost('alamat'),
            'no_hp'         => $this->request->getPost('no_hp'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'tanggal_lahir' => $this->request->getPost('tanggal_lahir'),
        ];

        // Kalau ada password baru, update juga
        if ($this->request->getPost('password')) {
            $data['password'] = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        }

        $this->userModel->update($userId, $data);

        $session->setFlashdata('success', 'Data berhasil diperbarui');
        return redirect()->to('/admin/settings');
    }
}
