<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\GuruMapel;
use App\Models\Mapel;
use App\Models\Nilai;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SekolahController extends Controller
{
    public function dashboard()
    {
        $rekapNilai = DB::select('SELECT * FROM nilai_siswa');
        $listGuru = DB::select('CALL List_guru()');

        return view('dashboard', compact('rekapNilai', 'listGuru'));
    }

    // --- MANAJEMEN GURU ---
    public function indexGuru()
    {
        $gurus = Guru::orderBy('nip')->get();
        return view('guru.index', compact('gurus'));
    }

    public function storeGuru(Request $request)
    {
        $data = $request->validate([
            'nip' => 'required|integer|unique:guru,nip',
            'nama' => 'required|string|max:100',
        ]);
        Guru::create($data);
        return back()->with('success', 'Data guru ditambahkan.');
    }

    public function updateGuru(Request $request, $nip)
    {
        $guru = Guru::findOrFail($nip);
        $data = $request->validate([
            'nama' => 'required|string|max:100',
        ]);
        $guru->update($data);
        return back()->with('success', 'Data guru diperbarui.');
    }

    public function destroyGuru($nip)
    {
        Guru::findOrFail($nip)->delete();
        return back()->with('success', 'Data guru dihapus.');
    }

    // --- MANAJEMEN SISWA ---
    public function indexSiswa()
    {
        $siswas = Siswa::orderBy('nis')->get();
        return view('siswa.index', compact('siswas'));
    }

    public function storeSiswa(Request $request)
    {
        $data = $request->validate([
            'nis' => 'required|integer|unique:siswa,nis',
            'nama' => 'required|string|max:100',
            'kelas' => 'required|string|max:50',
        ]);
        Siswa::create($data);
        return back()->with('success', 'Data siswa ditambahkan.');
    }

    public function updateSiswa(Request $request, $nis)
    {
        $siswa = Siswa::findOrFail($nis);
        $data = $request->validate([
            'nama' => 'required|string|max:100',
            'kelas' => 'required|string|max:50',
        ]);
        $siswa->update($data);
        return back()->with('success', 'Data siswa diperbarui.');
    }

    public function destroySiswa($nis)
    {
        Siswa::findOrFail($nis)->delete();
        return back()->with('success', 'Data siswa dihapus.');
    }

    // --- MANAJEMEN MAPEL ---
    public function indexMapel()
    {
        $mapels = Mapel::orderBy('id')->get();
        return view('mapel.index', compact('mapels'));
    }

    public function storeMapel(Request $request)
    {
        $data = $request->validate([
            'nama_mapel' => 'required|string|max:100',
        ]);
        Mapel::create($data);
        return back()->with('success', 'Data mapel ditambahkan.');
    }

    public function updateMapel(Request $request, $id)
    {
        $mapel = Mapel::findOrFail($id);
        $data = $request->validate([
            'nama_mapel' => 'required|string|max:100',
        ]);
        $mapel->update($data);
        return back()->with('success', 'Data mapel diperbarui.');
    }

    public function destroyMapel($id)
    {
        Mapel::findOrFail($id)->delete();
        return back()->with('success', 'Data mapel dihapus.');
    }

    // --- SETTING GURU MAPEL ---
    public function indexGuruMapel()
    {
        $items = GuruMapel::with(['guru', 'mapel'])->orderBy('id')->get();
        $gurus = Guru::orderBy('nama')->get();
        $mapels = Mapel::orderBy('nama_mapel')->get();
        return view('guru_mapel.index', compact('items', 'gurus', 'mapels'));
    }

    public function storeGuruMapel(Request $request)
    {
        $data = $request->validate([
            'nip' => 'required|exists:guru,nip',
            'id_mapel' => 'required|exists:mapel,id',
        ]);
        GuruMapel::create($data);
        return back()->with('success', 'Setting guru mapel disimpan.');
    }

    public function updateGuruMapel(Request $request, $id)
    {
        $item = GuruMapel::findOrFail($id);
        $data = $request->validate([
            'nip' => 'required|exists:guru,nip',
            'id_mapel' => 'required|exists:mapel,id',
        ]);
        $item->update($data);
        return back()->with('success', 'Setting guru mapel diperbarui.');
    }

    public function destroyGuruMapel($id)
    {
        GuruMapel::findOrFail($id)->delete();
        return back()->with('success', 'Setting guru mapel dihapus.');
    }

    // --- MANAJEMEN NILAI ---
    public function indexNilai()
    {
        $nilais = Nilai::with(['siswa', 'guruMapel.guru', 'guruMapel.mapel'])->orderBy('id', 'desc')->get();
        $siswas = Siswa::orderBy('nama')->get();
        $guruMapels = GuruMapel::with(['guru', 'mapel'])->get();
        return view('nilai.index', compact('nilais', 'siswas', 'guruMapels'));
    }

    public function storeNilai(Request $request)
    {
        $data = $request->validate([
            'nis' => 'required|exists:siswa,nis',
            'id_guru_mapel' => 'required|exists:guru_mapel,id',
            'nilai_ulangan' => 'required|integer|min:0|max:100',
            'nilai_uts' => 'required|integer|min:0|max:100',
            'nilai_uas' => 'required|integer|min:0|max:100',
        ]);

        // Trigger 'hitung' di MySQL akan otomatis mengisi kolom nilai_akhir
        Nilai::create($data);
        return back()->with('success', 'Nilai berhasil ditambahkan (NA dihitung otomatis oleh trigger).');
    }

    public function updateNilai(Request $request, $id)
    {
        $nilai = Nilai::findOrFail($id);
        $data = $request->validate([
            'nis' => 'required|exists:siswa,nis',
            'id_guru_mapel' => 'required|exists:guru_mapel,id',
            'nilai_ulangan' => 'required|integer|min:0|max:100',
            'nilai_uts' => 'required|integer|min:0|max:100',
            'nilai_uas' => 'required|integer|min:0|max:100',
        ]);

        $nilai->update($data);
        return back()->with('success', 'Nilai berhasil diperbarui.');
    }

    public function destroyNilai($id)
    {
        Nilai::findOrFail($id)->delete();
        return back()->with('success', 'Data nilai dihapus.');
    }
}