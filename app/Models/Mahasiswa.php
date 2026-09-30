<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Mahasiswa extends Model
{
    protected $fillable = [
        'nim',
        'nama',
        'semester',
        'prodi',
        'mata_kuliah',
        'ruang',
        'status',
    ];

    public function presensis(): HasMany
    {
        return $this->hasMany(Presensi::class);
    }
}