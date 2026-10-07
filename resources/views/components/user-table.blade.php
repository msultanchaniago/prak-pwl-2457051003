<div class="card shadow-sm border-0 rounded-3 overflow-hidden">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-dark">
                <tr>
                    <th scope="col" class="text-center" style="width: 8%;">No</th>
                    <th scope="col" style="width: 32%;">Nama Mahasiswa</th>
                    <th scope="col" style="width: 20%;">NPM</th>
                    <th scope="col" style="width: 15%;">Kelas</th>
                    <th scope="col" class="text-center" style="width: 25%;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $index => $user)
                <tr>
                    <td class="text-center text-muted fw-bold">{{ $loop->iteration }}</td>
                    <td>
                        <div class="d-flex align-items-center">
                            <div class="avatar-circle me-3 bg-primary bg-opacity-10 text-primary fw-bold d-flex align-items-center justify-content-center rounded-circle border border-primary border-opacity-25" style="width: 40px; height: 40px; font-size: 14px;">
                                {{ strtoupper(substr($user->nama, 0, 2)) }}
                            </div>
                            <div>
                                <div class="fw-bold text-dark">{{ $user->nama }}</div>
                                <small class="text-muted">ID: {{ $user->id }}</small>
                            </div>
                        </div>
                    </td>
                    <td>
                        <span class="badge bg-light text-dark border px-2 py-1 font-monospace fs-6">
                            <i class="bi bi-card-heading text-primary me-1"></i>{{ $user->nim }}
                        </span>
                    </td>
                    <td>
                        <span class="badge bg-primary-subtle text-primary border border-primary-subtle px-3 py-2 rounded-pill fw-semibold">
                            Kelas {{ $user->nama_kelas }}
                        </span>
                    </td>
                    <td class="text-center">
                        <div class="d-inline-flex gap-2">
                            <!-- Tombol Edit Kece -->
                            <a href="{{ route('user.edit', $user->id) }}" 
                               class="btn btn-sm btn-outline-warning text-dark fw-semibold px-3 py-1 d-inline-flex align-items-center rounded-pill shadow-sm"
                               title="Edit Data Mahasiswa">
                                <i class="bi bi-pencil-square me-1 text-warning-emphasis"></i> Edit
                            </a>

                            <!-- Tombol Hapus Kece -->
                            <form action="{{ route('user.destroy', $user->id) }}" method="POST" class="d-inline"
                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus data mahasiswa {{ $user->nama }} (NPM: {{ $user->nim }})?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="btn btn-sm btn-outline-danger fw-semibold px-3 py-1 d-inline-flex align-items-center rounded-pill shadow-sm"
                                        title="Hapus Data Mahasiswa">
                                    <i class="bi bi-trash3-fill me-1"></i> Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-5 text-muted">
                        <i class="bi bi-inbox fs-1 d-block mb-2 text-secondary"></i>
                        Belum ada data mahasiswa yang terdaftar.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>