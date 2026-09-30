<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Presensi;
use App\Models\SesiPresensi;
use Illuminate\Http\Request;

class PresensiController extends Controller
{
    public function scan($kodeQR)
    {
        $sesi = SesiPresensi::with([
            'kelas.dosen',
            'kelas.mataKuliah'
        ])
            ->where('kode_qr', $kodeQR)
            ->firstOrFail();

        if (!$sesi->aktif || now()->greaterThan($sesi->berakhir)) {
            return view('presensi.expired');
        }

        return view('presensi.scan', compact('sesi'));
    }

    public function store(Request $request, $kodeQR)
    {
        $request->validate([
            'nim' => 'required|string|exists:mahasiswas,nim',
        ]);

        $sesi = SesiPresensi::where('kode_qr', $kodeQR)
            ->firstOrFail();

        if (!$sesi->aktif || now()->greaterThan($sesi->berakhir)) {
            return back()->with(
                'error',
                'Sesi presensi sudah berakhir.'
            );
        }

        $mahasiswa = Mahasiswa::where(
            'nim',
            $request->nim
        )->firstOrFail();

        $sudahAbsen = Presensi::where(
            'mahasiswa_id',
            $mahasiswa->id
        )
            ->where(
                'sesi_presensi_id',
                $sesi->id
            )
            ->exists();

        if ($sudahAbsen) {
            return back()->with(
                'error',
                'Anda sudah melakukan presensi pada sesi ini.'
            );
        }

        $status = now()->greaterThan(
            $sesi->mulai->copy()->addMinutes(15)
        )
            ? 'terlambat'
            : 'hadir';

        Presensi::create([
            'mahasiswa_id' => $mahasiswa->id,
            'sesi_presensi_id' => $sesi->id,
            'waktu_scan' => now(),
            'status' => $status,
        ]);

        return view(
            'presensi.success',
            compact(
                'mahasiswa',
                'sesi',
                'status'
            )
        );
    }

   public function rekap(SesiPresensi $sesiPresensi)
{
    $sesiPresensi->load([
        'kelas.dosen',
        'kelas.mataKuliah',
        'presensis.mahasiswa',
    ]);

    $presensiMap = $sesiPresensi->presensis
        ->keyBy('mahasiswa_id');

    $mahasiswas = Mahasiswa::orderBy('nim')->get();

    return view('presensi.rekap', compact(
        'sesiPresensi',
        'mahasiswas',
        'presensiMap'
    ));
}
}