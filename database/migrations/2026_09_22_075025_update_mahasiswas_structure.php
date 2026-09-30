<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('mahasiswas', function (Blueprint $table) {
            $table->dropColumn(['email', 'kelas']);

            $table->integer('semester')->after('nama');
            $table->string('mata_kuliah')->after('prodi')->nullable();
            $table->string('status')->after('mata_kuliah')->default('Belum');
        });
    }

    public function down(): void
    {
        Schema::table('mahasiswas', function (Blueprint $table) {
            $table->string('email')->nullable();
            $table->string('kelas')->nullable();

            $table->dropColumn([
                'semester',
                'mata_kuliah',
                'status',
            ]);
        });
    }
};