<?php

namespace App\Imports;

use App\Models\Mahasiswa;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MahasiswaImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Lewati baris kosong
        if (empty(trim($row['nim'] ?? ''))) {
            return null;
        }

        return Mahasiswa::updateOrCreate(
            [
                'nim' => trim($row['nim']),
            ],
            [
                'nama' => trim($row['nama'] ?? ''),
                'semester' => $row['semester'] ?? 0,
                'prodi' => trim($row['prodi'] ?? ''),
                'mata_kuliah' => trim($row['mata_kuliah'] ?? ''),
                'status' => trim($row['status'] ?? 'Belum'),
            ]
        );
    }
}