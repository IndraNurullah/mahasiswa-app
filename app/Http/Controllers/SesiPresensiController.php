<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\SesiPresensi;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SesiPresensiController extends Controller
{
    public function index()
    {
        $sesiPresensis = SesiPresensi::with([
            'kelas.dosen',
            'kelas.mataKuliah',
        ])
            ->latest()
            ->get();

        return view('sesi-presensi.index', compact('sesiPresensis'));
    }

    public function create()
    {
        $kelas = Kelas::with([
            'dosen',
            'mataKuliah'
        ])->get();

        return view('sesi-presensi.create', compact('kelas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kelas_id' => 'required|exists:kelas,id',
            'durasi' => 'required|integer|min:1|max:180',
        ]);

        $sesi = SesiPresensi::create([
            'kelas_id' => $request->kelas_id,
            'kode_qr' => Str::uuid()->toString(),
            'mulai' => now(),
            'berakhir' => now()->addMinutes(
                (int) $request->durasi
            ),
            'aktif' => true,
        ]);

        return redirect()->route(
            'sesi-presensi.show',
            $sesi
        );
    }

    public function show(SesiPresensi $sesiPresensi)
    {
        $sesiPresensi->load([
            'kelas.dosen',
            'kelas.mataKuliah'
        ]);

        return view(
            'sesi-presensi.show',
            compact('sesiPresensi')
        );
    }
}