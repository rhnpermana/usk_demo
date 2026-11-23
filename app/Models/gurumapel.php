<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GuruMapel extends Model
{
    protected $table = 'guru_mapel';
    protected $fillable = ['nip', 'id_mapel'];

    public function guru()
    {
        return $this->belongsTo(Guru::class, 'nip', 'nip');
    }

    public function mapel()
    {
        return $this->belongsTo(Mapel::class, 'id_mapel', 'id');
    }

    public function nilai()
    {
        return $this->hasMany(Nilai::class, 'id_guru_mapel', 'id');
    }
}