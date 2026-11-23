@extends('layouts.app')

@section('content')
<h3 class="mb-3">Manajemen Nilai</h3>

<div class="card mb-4">
    <div class="card-header">Tambah Nilai</div>
    <div class="card-body">
        <form action="{{ route('nilai.store') }}" method="POST" class="row g-3">
            @csrf
            <div class="col-md-3">
                <label class="form-label">Siswa</label>
                <select name="nis" class="form-select" required>
                    <option value="">-- Pilih Siswa --</option>
                    @foreach($siswas as $s)
                        <option value="{{ $s->nis }}">{{ $s->nis }} - {{ $s->nama }} ({{ $s->kelas }})</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label">Guru - Mapel</label>
                <select name="id_guru_mapel" class="form-select" required>
                    <option value="">-- Pilih Guru & Mapel --</option>
                    @foreach($guruMapels as $gm)
                        <option value="{{ $gm->id }}">{{ $gm->guru->nama }} - {{ $gm->mapel->nama_mapel }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label">Ulangan (20%)</label>
                <input type="number" name="nilai_ulangan" min="0" max="100" class="form-control" required>
            </div>
            <div class="col-md-2">
                <label class="form-label">UTS (30%)</label>
                <input type="number" name="nilai_uts" min="0" max="100" class="form-control" required>
            </div>
            <div class="col-md-2">
                <label class="form-label">UAS (50%)</label>
                <input type="number" name="nilai_uas" min="0" max="100" class="form-control" required>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Simpan Nilai</button>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-body table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Siswa</th>
                    <th>Guru & Mapel</th>
                    <th>Ulangan</th>
                    <th>UTS</th>
                    <th>UAS</th>
                    <th>Nilai Akhir (NA)</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($nilais as $n)
                <tr>
                    <td>{{ $n->siswa->nama ?? '-' }}</td>
                    <td>{{ $n->guruMapel->guru->nama ?? '-' }} ({{ $n->guruMapel->mapel->nama_mapel ?? '-' }})</td>
                    <td>{{ $n->nilai_ulangan }}</td>
                    <td>{{ $n->nilai_uts }}</td>
                    <td>{{ $n->nilai_uas }}</td>
                    <td><strong>{{ $n->nilai_akhir }}</strong></td>
                    <td>
                        <form action="{{ route('nilai.destroy', $n->id) }}" method="POST" onsubmit="return confirm('Hapus data ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" type="submit">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection