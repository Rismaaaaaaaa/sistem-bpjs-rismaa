<?php
namespace App\Controllers;
use App\Models\UserModel;

class SettingsController extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        // Cek sesi di constructor
        if (!session()->has('user_id')) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu');
        }
    }

    public function index()
    {
        $userId = session()->get('user_id');
        $user = $this->userModel->find($userId);

        if (!$user) {
            return redirect()->to('/login')->with('error', 'User tidak ditemukan');
        }

        $data = [
            'user' => $user,
            'title' => 'Pengaturan Akun'
        ];

        return view('admin/settings', $data);
    }

    public function update()
    {
        $userId = session()->get('user_id');
        $user = $this->userModel->find($userId);

        if (!$user) {
            return redirect()->back()->with('error', 'User tidak ditemukan');
        }

        $rules = [
            'username' => 'required|min_length[3]|is_unique[users.username,id,'.$userId.']',
            'email' => 'required|valid_email|is_unique[users.email,id,'.$userId.']',
            'alamat' => 'permit_empty|string',
            'no_hp' => 'permit_empty|numeric',
            'jenis_kelamin' => 'permit_empty|in_list[Laki-laki,Perempuan]',
            'tanggal_lahir' => 'permit_empty|valid_date'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
            'alamat' => $this->request->getPost('alamat') ?: null,
            'no_hp' => $this->request->getPost('no_hp') ?: null,
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin') ?: null,
            'tanggal_lahir' => $this->request->getPost('tanggal_lahir') ?: null,
        ];

        if ($this->request->getPost('password')) {
            $data['password'] = password_hash($this->request->getPost('password'), PASSWORD_BCRYPT);
        }

        try {
            if ($this->userModel->update($userId, $data)) {
                // Update session jika username atau email berubah
                session()->set([
                    'username' => $data['username'],
                    'email' => $data['email']
                ]);
                return redirect()->to('admin/settings')->with('success', 'Profil berhasil diperbarui');
            } else {
                return redirect()->back()->with('error', 'Gagal memperbarui profil');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}