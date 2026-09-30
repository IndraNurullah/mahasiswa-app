<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
 Schema::create('presensis', function (Blueprint $table) {
    $table->id();

    $table->foreignId('mahasiswa_id')
        ->constrained('mahasiswas')
        ->cascadeOnDelete();

    $table->foreignId('sesi_presensi_id')
        ->constrained('sesi_presensis')
        ->cascadeOnDelete();

    $table->timestamp('waktu_scan')->nullable();

    $table->enum('status', [
        'hadir',
        'terlambat',
        'izin',
        'sakit',
        'alpha'
    ])->default('hadir');

    $table->timestamps();

    $table->unique(['mahasiswa_id', 'sesi_presensi_id']);
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('presensis');
    }
};
