@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-7 col-lg-6">
            <div class="card shadow border-0 rounded-4 overflow-hidden">
                <div class="card-header bg-warning bg-gradient text-dark py-3 px-4 d-flex align-items-center justify-content-between">
                    <div>
                        <h4 class="mb-0 fw-bold">
                            <i class="bi bi-pencil-square me-2"></i>Edit Data Mahasiswa
                        </h4>
                        <small class="text-muted">Perbarui informasi mahasiswa pada database</small>
                    </div>
                    <span class="badge bg-dark text-white rounded-pill px-3 py-2">ID: {{ $user->id }}</span>
                </div>
                <div class="card-body p-4 bg-white">
                    {{-- Alert Error Validasi --}}
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show shadow-sm border-start border-danger border-4" role="alert">
                            <div class="d-flex align-items-start">
                                <i class="bi bi-exclamation-triangle-fill fs-5 text-danger me-2 mt-1"></i>
                                <div>
                                    <strong>Terjadi Kesalahan:</strong>
                                    <ul class="mb-0 mt-1 small">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form action="{{ route('user.update', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="nama" class="form-label fw-semibold text-secondary">
                                <i class="bi bi-person me-1 text-primary"></i> Nama Lengkap
                            </label>
                            <input type="text" class="form-control form-control-lg fs-6 @error('nama') is-invalid @enderror" 
                                   id="nama" name="nama" value="{{ old('nama', $user->nama) }}" 
                                   required placeholder="Contoh: Muhammad Sultan Chaniago">
                            @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="npm" class="form-label fw-semibold text-secondary">
                                <i class="bi bi-card-heading me-1 text-primary"></i> NPM
                            </label>
                            <input type="text" class="form-control form-control-lg fs-6 @error('npm') is-invalid @enderror" 
                                   id="npm" name="npm" value="{{ old('npm', $user->nim) }}" 
                                   required placeholder="Contoh: 2457051003">
                            @error('npm')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="kelas_id" class="form-label fw-semibold text-secondary">
                                <i class="bi bi-building me-1 text-primary"></i> Kelas
                            </label>
                            <select name="kelas_id" id="kelas_id" class="form-select form-select-lg fs-6 @error('kelas_id') is-invalid @enderror" required>
                                <option value="" disabled>-- Pilih Kelas --</option>
                                @foreach ($kelas as $kelasItem)
                                    <option value="{{ $kelasItem->id }}" {{ old('kelas_id', $user->kelas_id) == $kelasItem->id ? 'selected' : '' }}>
                                        Kelas {{ $kelasItem->nama_kelas }}
                                    </option>
                                @endforeach
                            </select>
                            @error('kelas_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between align-items-center pt-3 border-top">
                            <a href="{{ route('user.index') }}" class="btn btn-outline-secondary px-4 rounded-pill">
                                <i class="bi bi-arrow-left me-1"></i> Batal
                            </a>
                            <button type="submit" class="btn btn-warning px-4 rounded-pill fw-bold shadow-sm">
                                <i class="bi bi-save me-1"></i> Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
