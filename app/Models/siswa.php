<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $table = 'siswa';
    protected $primaryKey = 'nis';
    public $incrementing = false;
    protected $keyType = 'int';
    protected $fillable = ['nis', 'nama', 'kelas'];

    public function nilai()
    {
        return $this->hasMany(Nilai::class, 'nis', 'nis');
    }
}