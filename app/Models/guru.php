<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    protected $table = 'guru';
    protected $primaryKey = 'nip';
    public $incrementing = false;
    protected $keyType = 'int';
    protected $fillable = ['nip', 'nama'];

    public function guruMapel()
    {
        return $this->hasMany(GuruMapel::class, 'nip', 'nip');
    }
}