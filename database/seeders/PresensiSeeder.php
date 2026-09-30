<?php

namespace Database\Seeders;

use App\Models\Dosen;
use App\Models\Kelas;
use App\Models\Mahasiswa;
use App\Models\MataKuliah;
use Illuminate\Database\Seeder;

class PresensiSeeder extends Seeder
{
    public function run(): void
    {
        $dosen = Dosen::create([
            'nidn' => '1234567890',
            'nama' => 'Dr. Budi Santoso',
            'email' => 'budi@example.com',
        ]);

        $mataKuliah = MataKuliah::create([
            'kode' => 'TI101',
            'nama' => 'Pemrograman Web',
            'sks' => 3,
            'dosen_id' => $dosen->id,
        ]);

        Kelas::create([
            'nama_kelas' => 'TI-4A',
            'dosen_id' => $dosen->id,
            'mata_kuliah_id' => $mataKuliah->id,
            'hari' => 'Senin',
            'jam_mulai' => '08:00',
            'jam_selesai' => '10:30',
        ]);

        Mahasiswa::create([
            'nim' => '20260001',
            'nama' => 'Andi Saputra',
            'email' => 'andi@example.com',
            'kelas' => 'TI-4A',
            'prodi' => 'Teknik Informatika',
        ]);

        Mahasiswa::create([
            'nim' => '20260002',
            'nama' => 'Siti Rahma',
            'email' => 'siti@example.com',
            'kelas' => 'TI-4A',
            'prodi' => 'Teknik Informatika',
        ]);

        Mahasiswa::create([
            'nim' => '20260003',
            'nama' => 'Rizky Maulana',
            'email' => 'rizky@example.com',
            'kelas' => 'TI-4A',
            'prodi' => 'Teknik Informatika',
        ]);
    }
}