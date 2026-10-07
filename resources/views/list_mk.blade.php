@extends('layouts.app')

@section('content')
<div class="container my-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3 mb-0">Daftar Mata Kuliah</h1>
        <a href="{{ route('matakuliah.create') }}" class="btn btn-primary">
            + Tambah Mata Kuliah Baru
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Berhasil!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Gagal!</strong> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="table-responsive shadow-sm rounded">
        <table class="table table-striped table-hover table-bordered mb-0">
            <thead class="table-dark">
                <tr>
                    <th style="width: 35%;">ID</th>
                    <th>NAMA MATA KULIAH</th>
                    <th style="width: 15%;">SKS</th>
                    <th style="width: 20%;" class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($mks as $mk)
                <tr>
                    <td><code>{{ $mk->id }}</code></td>
                    <td class="fw-semibold">{{ $mk->nama_mk }}</td>
                    <td><span class="badge bg-secondary fs-6">{{ $mk->sks }} SKS</span></td>
                    <td class="text-center">
                        <a href="{{ route('matakuliah.edit', $mk->id) }}" class="btn btn-sm btn-warning me-1">
                            Edit
                        </a>
                        <form action="{{ route('matakuliah.destroy', $mk->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center text-muted py-4">Belum ada data mata kuliah.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection