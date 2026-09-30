<?php

namespace App\Http\Controllers;

use App\Imports\MahasiswaImport;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class MahasiswaController extends Controller
{
    public function index()
    {
        $mahasiswas = Mahasiswa::orderBy('nim')->get();

        return view('mahasiswa.index', compact('mahasiswas'));
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls,csv|max:5120',
        ]);

        // Hapus data mahasiswa lama
        Mahasiswa::query()->delete();

        // Import data dari Excel terbaru
        Excel::import(
            new MahasiswaImport,
            $request->file('file')
        );

        return back()->with(
            'success',
            'Data mahasiswa berhasil diperbarui dari datasheet terbaru.'
        );
    }
}