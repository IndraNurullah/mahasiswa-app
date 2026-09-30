<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Presensi extends Model
{
    protected $fillable = [
        'mahasiswa_id',
        'sesi_presensi_id',
        'waktu_scan',
        'status',
    ];

    protected $casts = [
        'waktu_scan' => 'datetime',
    ];

    public function mahasiswa(): BelongsTo
    {
        return $this->belongsTo(Mahasiswa::class);
    }

    public function sesiPresensi(): BelongsTo
    {
        return $this->belongsTo(SesiPresensi::class);
    }
}