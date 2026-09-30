<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard Presensi</title>

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

        .layout {
            display: flex;
            min-height: 100vh;
        }

        /* SIDEBAR */

        .sidebar {
            width: 250px;
            background: #111827;
            color: white;
            padding: 25px 18px;
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
        }

        .logo {
            font-size: 21px;
            font-weight: bold;
            padding: 10px 12px 35px;
        }

        .logo span {
            color: #60a5fa;
        }

        .menu-title {
            font-size: 11px;
            color: #9ca3af;
            text-transform: uppercase;
            margin: 10px 12px;
        }

        .menu a {
            display: block;
            text-decoration: none;
            color: #d1d5db;
            padding: 13px 12px;
            border-radius: 9px;
            margin-bottom: 5px;
            font-size: 14px;
        }

        .menu a:hover,
        .menu .active {
            background: #1f2937;
            color: white;
        }

        /* CONTENT */

        .content {
            margin-left: 250px;
            width: calc(100% - 250px);
            padding: 30px;
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .topbar h1 {
            margin: 0;
            font-size: 28px;
        }

        .topbar p {
            margin: 7px 0 0;
            color: #6b7280;
        }

        .profile {
            background: white;
            padding: 10px 16px;
            border-radius: 10px;
            box-shadow: 0 3px 15px rgba(0,0,0,.05);
            font-size: 14px;
        }

        /* STATISTICS */

        .stats {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 18px;
            margin-bottom: 25px;
        }

        .stat-card {
            background: white;
            border-radius: 15px;
            padding: 22px;
            box-shadow: 0 4px 20px rgba(0,0,0,.05);
        }

        .stat-label {
            color: #6b7280;
            font-size: 13px;
        }

        .stat-number {
            font-size: 30px;
            font-weight: bold;
            margin-top: 10px;
        }

        .stat-icon {
            font-size: 25px;
        }

        /* MAIN GRID */

        .grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 20px;
        }

        .card {
            background: white;
            border-radius: 15px;
            padding: 22px;
            box-shadow: 0 4px 20px rgba(0,0,0,.05);
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .card-header h2 {
            margin: 0;
            font-size: 18px;
        }

        .button {
            display: inline-block;
            padding: 10px 15px;
            border-radius: 8px;
            background: #2563eb;
            color: white;
            text-decoration: none;
            font-size: 13px;
            font-weight: bold;
        }

        .button:hover {
            background: #1d4ed8;
        }

        /* SESSION */

        .session {
            border: 1px solid #e5e7eb;
            padding: 16px;
            border-radius: 11px;
            margin-bottom: 12px;
        }

        .session:last-child {
            margin-bottom: 0;
        }

        .session-title {
            font-weight: bold;
            margin-bottom: 7px;
        }

        .session-info {
            font-size: 13px;
            color: #6b7280;
            line-height: 1.7;
        }

        .session-actions {
            margin-top: 12px;
        }

        .small-button {
            display: inline-block;
            text-decoration: none;
            padding: 8px 12px;
            border-radius: 7px;
            background: #111827;
            color: white;
            font-size: 12px;
            margin-right: 5px;
        }

        .small-button.blue {
            background: #2563eb;
        }

        /* QUICK ACTION */

        .quick-action {
            display: block;
            padding: 16px;
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            margin-bottom: 12px;
            text-decoration: none;
            color: #111827;
        }

        .quick-action:hover {
            background: #f9fafb;
        }

        .quick-action strong {
            display: block;
            margin-bottom: 5px;
        }

        .quick-action span {
            font-size: 13px;
            color: #6b7280;
        }

        .empty {
            color: #6b7280;
            text-align: center;
            padding: 30px;
        }

        /* RESPONSIVE */

        @media (max-width: 900px) {

            .sidebar {
                width: 210px;
            }

            .content {
                margin-left: 210px;
                width: calc(100% - 210px);
            }

            .stats {
                grid-template-columns: repeat(2, 1fr);
            }

            .grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 650px) {

            .sidebar {
                display: none;
            }

            .content {
                margin-left: 0;
                width: 100%;
                padding: 20px;
            }

            .stats {
                grid-template-columns: 1fr 1fr;
                gap: 10px;
            }

            .stat-card {
                padding: 16px;
            }

            .stat-number {
                font-size: 24px;
            }

            .topbar {
                align-items: flex-start;
            }

            .profile {
                display: none;
            }
        }
    </style>
</head>

<body>

<div class="layout">

    <!-- SIDEBAR -->

    <aside class="sidebar">

        <div class="logo">
            PRESENSI<span>.</span>
        </div>

        <div class="menu-title">
            Menu Utama
        </div>

        <div class="menu">

            <a href="{{ route('dashboard') }}" class="active">
                🏠 &nbsp; Dashboard
            </a>

            <a href="{{ route('sesi-presensi.index') }}">
                📋 &nbsp; Sesi Presensi
            </a>

            <a href="{{ route('sesi-presensi.create') }}">
                ➕ &nbsp; Buat Presensi
            </a>

            <a href="{{ route('mahasiswa.index') }}">
                👨‍🎓 &nbsp; Data Mahasiswa
            </a>

        </div>

    </aside>


    <!-- CONTENT -->

    <main class="content">

        <div class="topbar">

            <div>
                <h1>Dashboard</h1>
                <p>Kelola presensi mahasiswa dengan mudah.</p>
            </div>

            <div class="profile">
                👨‍🏫 Dosen
            </div>

        </div>


        <!-- STATISTICS -->

        <div class="stats">

            <div class="stat-card">
                <div class="stat-icon">👨‍🎓</div>
                <div class="stat-label">Total Mahasiswa</div>
                <div class="stat-number">
                    {{ $jumlahMahasiswa }}
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon">📋</div>
                <div class="stat-label">Total Sesi Presensi</div>
                <div class="stat-number">
                    {{ $jumlahSesi }}
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon">✅</div>
                <div class="stat-label">Total Hadir</div>
                <div class="stat-number">
                    {{ $jumlahHadir }}
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon">⏰</div>
                <div class="stat-label">Total Terlambat</div>
                <div class="stat-number">
                    {{ $jumlahTerlambat }}
                </div>
            </div>

        </div>


        <!-- CONTENT GRID -->

        <div class="grid">

            <!-- SESI TERBARU -->

            <div class="card">

                <div class="card-header">

                    <h2>Sesi Presensi Terbaru</h2>

                    <a
                        href="{{ route('sesi-presensi.create') }}"
                        class="button"
                    >
                        + Buat Sesi
                    </a>

                </div>


                @forelse($sesiTerbaru as $sesi)

                    <div class="session">

                        <div class="session-title">

                            {{ $sesi->kelas->mataKuliah->nama ?? '-' }}

                        </div>

                        <div class="session-info">

                            Kelas:
                            {{ $sesi->kelas->nama_kelas ?? '-' }}

                            <br>

                            Dosen:
                            {{ $sesi->kelas->dosen->nama ?? '-' }}

                            <br>

                            Dibuat:
                            {{ $sesi->created_at->format('d M Y, H:i') }}

                        </div>

                        <div class="session-actions">

                            <a
                                href="{{ route('sesi-presensi.show', $sesi) }}"
                                class="small-button blue"
                            >
                                Lihat QR
                            </a>

                            <a
                                href="{{ route('presensi.rekap', $sesi) }}"
                                class="small-button"
                            >
                                Rekap
                            </a>

                        </div>

                    </div>

                @empty

                    <div class="empty">
                        Belum ada sesi presensi.
                    </div>

                @endforelse

            </div>


            <!-- QUICK ACTION -->

            <div class="card">

                <div class="card-header">

                    <h2>Aksi Cepat</h2>

                </div>

                <a
                    href="{{ route('sesi-presensi.create') }}"
                    class="quick-action"
                >
                    <strong>➕ Buat Sesi Presensi</strong>
                    <span>
                        Buat QR presensi baru untuk kelas.
                    </span>
                </a>

                <a
                    href="{{ route('sesi-presensi.index') }}"
                    class="quick-action"
                >
                    <strong>📋 Semua Sesi</strong>
                    <span>
                        Lihat seluruh sesi presensi.
                    </span>
                </a>

                <a
                    href="{{ route('mahasiswa.index') }}"
                    class="quick-action"
                >
                    <strong>👨‍🎓 Data Mahasiswa</strong>
                    <span>
                        Kelola data mahasiswa.
                    </span>
                </a>

            </div>

        </div>

    </main>

</div>

</body>
</html>