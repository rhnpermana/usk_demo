@extends('Layout.App')

@section('content')
<h3 class="mb-3">Manajemen Guru</h3>
<div class="card mb-4">
    <div class="card-body">
        <form action="{{ route('guru.store') }}" method="POST" class="row g-3">
            @csrf
            <div class="col-md-4">
                <label class="form-label">NIP</label>
                <input type="number" name="nip" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Nama Guru</label>
                <input type="text" name="nama" class="form-control" required>
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
            <thead><tr><th>NIP</th><th>Nama</th><th>Aksi</th></tr></thead>
            <tbody>
                @forelse($gurus as $g)
                <tr>
                    <td>{{ $g->nip }}</td>
                    <td>{{ $g->nama }}</td>
                    <td>
                        <form action="{{ route('guru.destroy', $g->nip) }}" method="POST" onsubmit="return confirm('Hapus data?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="3" class="text-center">Belum ada data guru.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection