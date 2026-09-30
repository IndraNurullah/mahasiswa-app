<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Rekap Presensi</title>

    <style>

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: #f5f7fb;
            color: #111827;
        }

        .header {
            background: #111827;
            color: white;
            padding: 18px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .brand {
            font-size: 19px;
            font-weight: bold;
        }

        .back {
            color: #d1d5db;
            text-decoration: none;
            font-size: 14px;
        }

        .container {
            max-width: 1200px;
            margin: 35px auto;
            padding: 0 20px;
        }

        .title {
            margin-bottom: 25px;
        }

        .title h1 {
            margin: 0;
            font-size: 28px;
        }

        .title p {
            color: #6b7280;
            margin-top: 8px;
        }

        .info {
            background: white;
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 4px 20px rgba(0,0,0,.05);
        }

        .info-title {
            font-size: 19px;
            font-weight: bold;
            margin-bottom: 8px;
        }

        .info-text {
            color: #6b7280;
            line-height: 1.7;
            font-size: 14px;
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
            margin-bottom: 20px;
        }

        .stat {
            background: white;
            border-radius: 14px;
            padding: 20px;
            box-shadow: 0 4px 20px rgba(0,0,0,.05);
        }

        .stat-label {
            color: #6b7280;
            font-size: 13px;
        }

        .stat-number {
            font-size: 28px;
            font-weight: bold;
            margin-top: 8px;
        }

        .green {
            color: #15803d;
        }

        .yellow {
            color: #ca8a04;
        }

        .red {
            color: #dc2626;
        }

        .table-card {
            background: white;
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 4px 20px rgba(0,0,0,.05);
        }

        .table-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 18px;
        }

        .table-header h2 {
            margin: 0;
            font-size: 18px;
        }

        .table-wrapper {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background: #111827;
            color: white;
            padding: 13px;
            text-align: left;
            font-size: 13px;
        }

        td {
            padding: 13px;
            border-bottom: 1px solid #e5e7eb;
            font-size: 13px;
        }

        tr:hover td {
            background: #f9fafb;
        }

        .badge {
            display: inline-block;
            padding: 6px 10px;
            border-radius: 50px;
            font-size: 11px;
            font-weight: bold;
        }

        .badge-hadir {
            background: #dcfce7;
            color: #166534;
        }

        .badge-terlambat {
            background: #fef3c7;
            color: #92400e;
        }

        .badge-belum {
            background: #fee2e2;
            color: #991b1b;
        }

        .badge-other {
            background: #e5e7eb;
            color: #374151;
        }

        @media(max-width: 700px) {

            .header {
                padding: 16px 20px;
            }

            .container {
                margin-top: 20px;
            }

            .stats {
                grid-template-columns: 1fr;
            }

        }

    </style>

</head>


<body>


<header class="header">

    <div class="brand">
        PRESENSI.
    </div>

    <a
        href="{{ route('dashboard') }}"
        class="back"
    >
        ← Dashboard
    </a>

</header>


<div class="container">


    <div class="title">

        <h1>Rekap Presensi</h1>

        <p>
            Daftar kehadiran mahasiswa pada sesi ini.
        </p>

    </div>


    <!-- INFO KELAS -->

    <div class="info">

        <div class="info-title">

            {{ $sesiPresensi->kelas->mataKuliah->nama ?? '-' }}

        </div>

        <div class="info-text">

            Kelas:
            {{ $sesiPresensi->kelas->nama_kelas ?? '-' }}

            <br>

            Dosen:
            {{ $sesiPresensi->kelas->dosen->nama ?? '-' }}

            <br>

            Sesi dibuat:
            {{ $sesiPresensi->created_at->format('d-m-Y H:i') }}

        </div>

    </div>


    @php

        $totalMahasiswa = $mahasiswas->count();

        $totalHadir = $presensiMap
            ->where('status', 'hadir')
            ->count();

        $totalTerlambat = $presensiMap
            ->where('status', 'terlambat')
            ->count();

        $totalBelum = $totalMahasiswa
            - $totalHadir
            - $totalTerlambat;

    @endphp


    <!-- STATISTICS -->

    <div class="stats">

        <div class="stat">

            <div class="stat-label">
                HADIR
            </div>

            <div class="stat-number green">
                {{ $totalHadir }}
            </div>

        </div>


        <div class="stat">

            <div class="stat-label">
                TERLAMBAT
            </div>

            <div class="stat-number yellow">
                {{ $totalTerlambat }}
            </div>

        </div>


        <div class="stat">

            <div class="stat-label">
                BELUM ABSEN
            </div>

            <div class="stat-number red">
                {{ $totalBelum }}
            </div>

        </div>

    </div>


    <!-- TABLE -->

    <div class="table-card">

        <div class="table-header">

            <h2>
                Data Mahasiswa
            </h2>

            <strong>
                {{ $totalMahasiswa }} Mahasiswa
            </strong>

        </div>


        <div class="table-wrapper">

            <table>

                <thead>

                    <tr>

                        <th>No</th>

                        <th>NIM</th>

                        <th>Nama</th>

                        <th>Semester</th>

                        <th>Prodi</th>

                        <th>Status</th>

                        <th>Waktu Scan</th>

                    </tr>

                </thead>


                <tbody>

                @forelse($mahasiswas as $index => $mahasiswa)

                    @php

                        $presensi =
                            $presensiMap->get(
                                $mahasiswa->id
                            );

                    @endphp


                    <tr>

                        <td>
                            {{ $index + 1 }}
                        </td>

                        <td>
                            <strong>
                                {{ $mahasiswa->nim }}
                            </strong>
                        </td>

                        <td>
                            {{ $mahasiswa->nama }}
                        </td>

                        <td>
                            {{ $mahasiswa->semester ?? '-' }}
                        </td>

                        <td>
                            {{ $mahasiswa->prodi ?? '-' }}
                        </td>


                        <td>

                            @if(!$presensi)

                                <span class="badge badge-belum">
                                    BELUM ABSEN
                                </span>

                            @elseif($presensi->status === 'hadir')

                                <span class="badge badge-hadir">
                                    HADIR
                                </span>

                            @elseif($presensi->status === 'terlambat')

                                <span class="badge badge-terlambat">
                                    TERLAMBAT
                                </span>

                            @else

                                <span class="badge badge-other">
                                    {{ strtoupper($presensi->status) }}
                                </span>

                            @endif

                        </td>


                        <td>

                            @if(
                                $presensi &&
                                $presensi->waktu_scan
                            )

                                {{ $presensi->waktu_scan->format('d-m-Y H:i:s') }}

                            @else

                                -

                            @endif

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td
                            colspan="7"
                            style="text-align:center;padding:30px;"
                        >
                            Belum ada data mahasiswa.

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>


</div>

</body>

</html>