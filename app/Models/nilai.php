<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    protected $table = 'nilai';
    protected $fillable = [
        'nis',
        'nilai_ulangan',
        'nilai_uts',
        'nilai_uas',
        'nilai_akhir',
        'id_guru_mapel',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'nis', 'nis');
    }

    public function guruMapel()
    {
        return $this->belongsTo(GuruMapel::class, 'id_guru_mapel', 'id');
    }
}