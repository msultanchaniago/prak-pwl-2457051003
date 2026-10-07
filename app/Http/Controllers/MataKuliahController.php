<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MataKuliah;

class MataKuliahController extends Controller
{
    // READ: tampilkan daftar mata kuliah
    public function index()
    {
        $data = [
            'title' => 'List Mata Kuliah',
            'mks'   => MataKuliah::all(),
        ];
        return view('list_mk', $data);
    }

    // Tampilkan form input
    public function create()
    {
        return view('create_mk', ['title' => 'Create Mata Kuliah']);
    }

    // CREATE: simpan data baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_mk' => 'required',
            'sks'     => 'required|integer|min:1|max:6',
        ]);

        MataKuliah::create([
            'nama_mk' => $request->input('nama_mk'),
            'sks'     => $request->input('sks'),
        ]);

        return redirect()->to('/mata-kuliah')->with('success', 'Data mata kuliah berhasil ditambahkan!');
    }

    // EDIT: tampilkan form edit data mata kuliah
    public function edit($id)
    {
        $mk = MataKuliah::findOrFail($id);
        return view('edit_mk', ['title' => 'Edit Mata Kuliah', 'mk' => $mk]);
    }

    // UPDATE: simpan perubahan data ke database
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_mk' => 'required',
            'sks'     => 'required|integer|min:1|max:6',
        ]);

        $mk = MataKuliah::findOrFail($id);
        $mk->update([
            'nama_mk' => $request->input('nama_mk'),
            'sks'     => $request->input('sks'),
        ]);

        return redirect()->to('/mata-kuliah')->with('success', 'Data berhasil diperbarui!');
    }

    // DESTROY: hapus data mata kuliah
    public function destroy($id)
    {
        $mk = MataKuliah::findOrFail($id);
        $mk->delete();

        return redirect()->to('/mata-kuliah')->with('success', 'Data berhasil dihapus!');
    }
}