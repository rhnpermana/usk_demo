@extends('Layout.App')

@section('content')
<h3 class="mb-3">Manajemen Siswa</h3>
<div class="card mb-4">
    <div class="card-body">
        <form action="{{ route('siswa.store') }}" method="POST" class="row g-3">
            @csrf
            <div class="col-md-3">
                <label class="form-label">NIS</label>
                <input type="number" name="nis" class="form-control" required>
            </div>
            <div class="col-md-4">
                <label class="form-label">Nama Siswa</label>
                <input type="text" name="nama" class="form-control" required>
            </div>
            <div class="col-md-3">
                <label class="form-label">Kelas</label>
                <input type="text" name="kelas" class="form-control" required>
            </div>
            <div class="col-md-2 d-flex align-items-end">
                <button type="submit" class="btn btn-primary w-100">Tambah</button>
            </div>
        </form>
    </div>
</div>
<div class="card">
    <div class="card-body table-responsive">
        <table class="table table-bordered">
            <thead><tr><th>NIS</th><th>Nama</th><th>Kelas</th><th>Aksi</th></tr></thead>
            <tbody>
                @forelse($siswas as $s)
                <tr>
                    <td>{{ $s->nis }}</td>
                    <td>{{ $s->nama }}</td>
                    <td>{{ $s->kelas }}</td>
                    <td>
                        <form action="{{ route('siswa.destroy', $s->nis) }}" method="POST" onsubmit="return confirm('Hapus data?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="4" class="text-center">Belum ada data siswa.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection