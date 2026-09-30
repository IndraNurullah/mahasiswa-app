<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\SesiPresensi;
use App\Models\Presensi;

class DashboardController extends Controller
{
    public function index()
    {
        $jumlahMahasiswa = Mahasiswa::count();

        $jumlahSesi = SesiPresensi::count();

        $jumlahHadir = Presensi::where('status', 'hadir')->count();

        $jumlahTerlambat = Presensi::where('status', 'terlambat')->count();

        $sesiTerbaru = SesiPresensi::with([
            'kelas.dosen',
            'kelas.mataKuliah'
        ])
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'jumlahMahasiswa',
            'jumlahSesi',
            'jumlahHadir',
            'jumlahTerlambat',
            'sesiTerbaru'
        ));
    }
}