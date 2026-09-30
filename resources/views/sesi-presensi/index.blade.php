<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Daftar Sesi Presensi</title>

    <style>

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            padding: 30px 20px;
        }

        .container {
            max-width: 1100px;
            margin: auto;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            margin-bottom: 25px;
        }

        h1 {
            margin: 0;
        }

        .btn {
            display: inline-block;
            padding: 12px 18px;
            border-radius: 10px;
            text-decoration: none;
            background: #222;
            color: white;
            font-weight: bold;
        }

        .btn:hover {
            opacity: 0.9;
        }

        .card {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(0,0,0,0.06);
        }

        .table-wrapper {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 800px;
        }

        th,
        td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }

        th {
            background: #f8f9fa;
            font-size: 14px;
        }

        td {
            font-size: 14px;
        }

        .status {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
        }

        .active {
            background: #d1fae5;
            color: #065f46;
        }

        .expired {
            background: #fee2e2;
            color: #991b1b;
        }

        .actions {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .btn-small {
            padding: 8px 12px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 13px;
            font-weight: bold;
            background: #222;
            color: white;
        }

        .btn-rekap {
            background: #555;
        }

        .empty {
            padding: 50px;
            text-align: center;
            color: #777;
        }

        @media (max-width: 700px) {

            .header {
                flex-direction: column;
                align-items: flex-start;
            }

        }

    </style>

</head>

<body>

<div class="container">

    <div class="header">

        <div>

            <h1>Daftar Sesi Presensi</h1>

            <p>
                Kelola sesi presensi perkuliahan
            </p>

        </div>

        <a
            href="{{ route('sesi-presensi.create') }}"
            class="btn"
        >
            + Buat Sesi
        </a>

    </div>


    <div class="card">

        @if($sesiPresensis->count() > 0)

            <div class="table-wrapper">

                <table>

                    <thead>

                        <tr>

                            <th>No</th>

                            <th>Mata Kuliah</th>

                            <th>Kelas</th>

                            <th>Dosen</th>

                            <th>Mulai</th>

                            <th>Status</th>

                            <th>Aksi</th>

                        </tr>

                    </thead>

                    <tbody>

                    @foreach($sesiPresensis as $sesi)

                        @php

                            $isAktif =
                                $sesi->aktif &&
                                now()->lessThan($sesi->berakhir);

                        @endphp

                        <tr>

                            <td>
                                {{ $loop->iteration }}
                            </td>

                            <td>
                                <strong>
                                    {{ $sesi->kelas->mataKuliah->nama }}
                                </strong>
                            </td>

                            <td>
                                {{ $sesi->kelas->nama_kelas }}
                            </td>

                            <td>
                                {{ $sesi->kelas->dosen->nama }}
                            </td>

                            <td>
                                {{ $sesi->mulai?->format('d-m-Y H:i') }}
                            </td>

                            <td>

                                @if($isAktif)

                                    <span class="status active">
                                        AKTIF
                                    </span>

                                @else

                                    <span class="status expired">
                                        BERAKHIR
                                    </span>

                                @endif

                            </td>

                            <td>

                                <div class="actions">

                                    <a
                                        href="{{ route('sesi-presensi.show', $sesi) }}"
                                        class="btn-small"
                                    >
                                        QR
                                    </a>

                                    <a
                                        href="{{ route('presensi.rekap', $sesi) }}"
                                        class="btn-small btn-rekap"
                                    >
                                        Lihat Rekap
                                    </a>

                                </div>

                            </td>

                        </tr>

                    @endforeach

                    </tbody>

                </table>

            </div>

        @else

            <div class="empty">

                <h3>Belum ada sesi presensi</h3>

                <p>
                    Silakan buat sesi presensi baru.
                </p>

            </div>

        @endif

    </div>

</div>

</body>

</html>