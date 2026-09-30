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
      Schema::create('sesi_presensis', function (Blueprint $table) {
    $table->id();
    $table->foreignId('kelas_id')->constrained('kelas')->cascadeOnDelete();
    $table->string('kode_qr')->unique();
    $table->timestamp('mulai')->nullable();
$table->timestamp('berakhir')->nullable();
    $table->boolean('aktif')->default(true);
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sesi_presensis');
    }
};
