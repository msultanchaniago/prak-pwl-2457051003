@extends('layouts.app')

@section('content')
<div class="container my-4">
    <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
        <div>
            <h1 class="h3 fw-bold text-dark mb-1">Daftar Pengguna / Mahasiswa</h1>
            <p class="text-muted small mb-0">Kelola data mahasiswa dengan operasi CRUD (Update & Delete)</p>
        </div>
        <a href="{{ route('user.create') }}" class="btn btn-primary d-inline-flex align-items-center shadow-sm fw-semibold">
            <i class="bi bi-person-plus-fill me-2"></i> Tambah Pengguna Baru
        </a>
    </div>

    {{-- Alert Notifikasi Sukses --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm border-start border-success border-4" role="alert">
            <div class="d-flex align-items-center">
                <i class="bi bi-check-circle-fill fs-4 text-success me-2"></i>
                <div>
                    <strong>Berhasil!</strong> {{ session('success') }}
                </div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Alert Notifikasi Error --}}
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show shadow-sm border-start border-danger border-4" role="alert">
            <div class="d-flex align-items-center">
                <i class="bi bi-exclamation-triangle-fill fs-4 text-danger me-2"></i>
                <div>
                    <strong>Perhatian!</strong> {{ session('error') }}
                </div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <x-user-table :users="$users" />
</div>
@endsection