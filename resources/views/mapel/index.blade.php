@extends('Layout.App')

@section('content')
<h3 class="mb-3">Manajemen Mapel</h3>
<div class="card mb-4">
    <div class="card-body">
        <form action="{{ route('mapel.store') }}" method="POST" class="row g-3">
            @csrf
            <div class="col-md-9">
                <label class="form-label">Nama Mapel</label>
                <input type="text" name="nama_mapel" class="form-control" required>
            </div>
            <div class="col-md-3 d-flex align-items-end">
                <button type="submit" class="btn btn-primary w-100">Tambah</button>
            </div>
        </form>
    </div>
</div>
<div class="card">
    <div class="card-body table-responsive">
        <table class="table table-bordered">
            <thead><tr><th>ID</th><th>Nama Mapel</th><th>Aksi</th></tr></thead>
            <tbody>
                @forelse($mapels as $m)
                <tr>
                    <td>{{ $m->id }}</td>
                    <td>{{ $m->nama_mapel }}</td>
                    <td>
                        <form action="{{ route('mapel.destroy', $m->id) }}" method="POST" onsubmit="return confirm('Hapus data?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="3" class="text-center">Belum ada data mapel.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection