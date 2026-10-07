<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\UserModel;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public $userModel;
    public $kelasModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->kelasModel = new Kelas();
    }

    // READ: Tampilkan daftar pengguna
    public function index()
    {
        $data = [
            'title' => 'List User',
            'users' => $this->userModel->getUser(),
        ];
        return view('list_user', $data);
    }

    // CREATE: Tampilkan form tambah pengguna
    public function create()
    {
        $kelas = $this->kelasModel->getKelas();
        $data = [
            'title' => 'Create User',
            'kelas' => $kelas,
        ];
        return view('create_user', $data);
    }

    // STORE: Simpan pengguna baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'nama'     => 'required|string|max:255',
            'npm'      => 'required',
            'kelas_id' => 'required|exists:kelas,id',
        ]);

        $this->userModel->create([
            'nama'     => $request->input('nama'),
            'nim'      => $request->input('npm'),
            'kelas_id' => $request->input('kelas_id'),
        ]);

        return redirect()->to('/user')->with('success', 'Data user berhasil ditambahkan!');
    }

    // EDIT: Tampilkan form edit pengguna berdasarkan ID
    public function edit($id)
    {
        $user = UserModel::findOrFail($id);
        $kelas = $this->kelasModel->getKelas();
        $data = [
            'title' => 'Edit User',
            'user'  => $user,
            'kelas' => $kelas,
        ];
        return view('edit_user', $data);
    }

    // UPDATE: Perbarui data pengguna di database menggunakan Eloquent ORM
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama'     => 'required|string|max:255',
            'npm'      => 'required',
            'kelas_id' => 'required|exists:kelas,id',
        ]);

        $user = UserModel::findOrFail($id);
        $user->update([
            'nama'     => $request->input('nama'),
            'nim'      => $request->input('npm'),
            'kelas_id' => $request->input('kelas_id'),
        ]);

        return redirect()->to('/user')->with('success', 'Data user berhasil diperbarui!');
    }

    // DESTROY: Hapus data pengguna dari database menggunakan Eloquent ORM
    public function destroy($id)
    {
        $user = UserModel::findOrFail($id);
        $user->delete();

        return redirect()->to('/user')->with('success', 'Data user berhasil dihapus!');
    }
}