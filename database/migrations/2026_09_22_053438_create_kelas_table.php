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
       Schema::create('kelas', function (Blueprint $table) {
    $table->id();
    $table->string('nama_kelas');
    $table->foreignId('dosen_id')->constrained('dosens')->cascadeOnDelete();
    $table->foreignId('mata_kuliah_id')->constrained('mata_kuliahs')->cascadeOnDelete();
    $table->string('hari')->nullable();
    $table->time('jam_mulai')->nullable();
    $table->time('jam_selesai')->nullable();
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kelas');
    }
};
