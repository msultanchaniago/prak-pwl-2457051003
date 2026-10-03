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
        MataKuliah::create([
            'nama_mk' => $request->input('nama_mk'),
            'sks'     => $request->input('sks'),
        ]);

        return redirect()->to('/matakuliah');
    }
}