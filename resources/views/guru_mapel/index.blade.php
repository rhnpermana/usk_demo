@extends('Layout.App')

@section('content')
<h3 class="mb-3">Setting Guru Mapel</h3>
<div class="card mb-4">
    <div class="card-body">
        <form action="{{ route('guru-mapel.store') }}" method="POST" class="row g-3">
            @csrf
            <div class="col-md-5">
                <label class="form-label">Guru</label>
                <select name="nip" class="form-select" required>
                    <option value="">-- Pilih Guru --</option>
                    @foreach($gurus as $g)
                        <option value="{{ $g->nip }}">{{ $g->nip }} - {{ $g->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-5">
                <label class="form-label">Mapel</label>
                <select name="id_mapel" class="form-select" required>
                    <option value="">-- Pilih Mapel --</option>
                    @foreach($mapels as $m)
                        <option value="{{ $m->id }}">{{ $m->nama_mapel }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2 d-flex align-items-end">
                <button type="submit" class="btn btn-primary w-100">Simpan</button>
            </div>
        </form>
    </div>
</div>
<div class="card">
    <div class="card-body table-responsive">
        <table class="table table-bordered">
            <thead><tr><th>ID</th><th>Guru</th><th>Mapel</th><th>Aksi</th></tr></thead>
            <tbody>
                @forelse($items as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->guru->nama ?? '-' }}</td>
                    <td>{{ $item->mapel->nama_mapel ?? '-' }}</td>
                    <td>
                        <form action="{{ route('guru-mapel.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus data?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="4" class="text-center">Belum ada setting guru mapel.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection