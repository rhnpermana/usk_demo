<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mapel extends Model
{
    protected $table = 'mapel';
    protected $fillable = ['nama_mapel'];

    public function guruMapel()
    {
        return $this->hasMany(GuruMapel::class, 'id_mapel', 'id');
    }
}