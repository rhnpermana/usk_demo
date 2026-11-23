@extends('Layout.App')

@section('content')
<h3 class="mb-3">Rekap Nilai Siswa (View: <code>nilai_siswa</code>)</h3>
<div class="card mb-4">
    <div class="card-body table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>NIS</th>
                    <th>Nama</th>
                    <th>Kelas</th>
                    <th>Nama Mapel</th>
                    <th>Nama Guru</th>
                    <th>NA</th>
                </tr>
            </thead>
            <tbody>
                @forelse($rekapNilai as $row)
                <tr>
                    <td>{{ $row->NIS }}</td>
                    <td>{{ $row->Nama }}</td>
                    <td>{{ $row->Kelas }}</td>
                    <td>{{ $row->Nama_Mapel }}</td>
                    <td>{{ $row->Nama_Guru }}</td>
                    <td><strong>{{ $row->NA }}</strong></td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center">Belum ada data nilai.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<h3 class="mb-3">Daftar Guru & Mapel (Procedure: <code>List_guru</code>)</h3>
<div class="card">
    <div class="card-body table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>NIP</th>
                    <th>Nama</th>
                    <th>Kode Mapel</th>
                    <th>Nama Mapel</th>
                </tr>
            </thead>
            <tbody>
                @forelse($listGuru as $g)
                <tr>
                    <td>{{ $g->NIP }}</td>
                    <td>{{ $g->Nama }}</td>
                    <td>{{ $g->Kode_Mapel }}</td>
                    <td>{{ $g->Nama_Mapel }}</td>
                </tr>
                @empty
                <tr><td colspan="4" class="text-center">Belum ada data guru mapel.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection