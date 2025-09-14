<?php

namespace App\Controllers;

use App\Models\UserModel;

class TambahUserController extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    // tampil form tambah user
    public function index()
    {
        return view('admin/tambah_user');
    }

    // simpan data user baru
    public function store()
    {
        $rules = [
            'username' => 'required|min_length[3]|is_unique[users.username]',
            'email'    => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[6]',
            'role'     => 'required|in_list[admin,superadmin]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->userModel->save([
            'username'      => $this->request->getPost('username'),
            'email'         => $this->request->getPost('email'),
            'password'      => password_hash($this->request->getPost('password'), PASSWORD_BCRYPT),
            'role'          => $this->request->getPost('role'),
            'alamat'        => $this->request->getPost('alamat'),
            'no_hp'         => $this->request->getPost('no_hp'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'tanggal_lahir' => $this->request->getPost('tanggal_lahir'),
        ]);

        return redirect()->to('admin/users')->with('success', 'User berhasil ditambahkan!');
    }

    // tampil list semua user
    public function list()
    {
        $data['users'] = $this->userModel->findAll();
        return view('admin/list_user', $data);
    }

    // tampil form edit user
    public function edit($id)
    {
        $data['user'] = $this->userModel->find($id);
        if (!$data['user']) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("User dengan ID $id tidak ditemukan");
        }

        return view('admin/edit_user', $data);
    }

    // update user
  public function update()
{
    $id = $this->request->getPost('id');
    $user = $this->userModel->find($id);

    if (!$user) {
        return redirect()->to('/admin/users')->with('error', 'User tidak ditemukan');
    }

    $rules = [
        'username' => "required|min_length[3]|is_unique[users.username,id,{$id}]",
        'email'    => "required|valid_email|is_unique[users.email,id,{$id}]",
        'role'     => 'required|in_list[admin,superadmin]',
    ];

    if (!$this->validate($rules)) {
        return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    }

    $dataUpdate = [
        'username'      => $this->request->getPost('username'),
        'email'         => $this->request->getPost('email'),
        'role'          => $this->request->getPost('role'),
        'alamat'        => $this->request->getPost('alamat'),
        'no_hp'         => $this->request->getPost('no_hp'),
        'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
        'tanggal_lahir' => $this->request->getPost('tanggal_lahir'),
    ];

    if ($this->request->getPost('password')) {
        $dataUpdate['password'] = password_hash($this->request->getPost('password'), PASSWORD_BCRYPT);
    }

    $this->userModel->update($id, $dataUpdate);

    return redirect()->to('/admin/users')->with('success', 'User berhasil diperbarui');
}


    // hapus user
    public function delete($id)
    {
        $this->userModel->delete($id);
        return redirect()->to('/admin/users')->with('success', 'User berhasil dihapus');
    }
}
