@extends('layouts.app')

@section('content')
<div class="container my-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Buat Mata Kuliah Baru</h4>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('matakuliah.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="nama_mk" class="form-label fw-bold">Nama Mata Kuliah:</label>
                            <input type="text" class="form-control" id="nama_mk" name="nama_mk" value="{{ old('nama_mk') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="sks" class="form-label fw-bold">SKS:</label>
                            <input type="number" class="form-control" id="sks" name="sks" value="{{ old('sks') }}" min="1" max="6" required>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('matakuliah.index') }}" class="btn btn-secondary">Kembali</a>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection