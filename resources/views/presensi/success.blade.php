<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Presensi Berhasil</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .card {
            width: 100%;
            max-width: 450px;
            background: white;
            border-radius: 20px;
            padding: 35px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
        }

        .icon {
            width: 80px;
            height: 80px;
            margin: 0 auto 20px;
            border-radius: 50%;
            background: #d1fae5;
            color: #065f46;
            font-size: 45px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        h1 {
            margin: 0 0 10px;
            color: #111;
        }

        .success {
            color: #059669;
            font-weight: bold;
            font-size: 18px;
            margin-bottom: 25px;
        }

        .info {
            background: #f5f5f5;
            border-radius: 12px;
            padding: 18px;
            text-align: left;
        }

        .info p {
            margin: 9px 0;
        }

        .status {
            display: inline-block;
            margin-top: 20px;
            padding: 8px 18px;
            border-radius: 20px;
            background: #d1fae5;
            color: #065f46;
            font-weight: bold;
        }
    </style>
</head>

<body>

<div class="card">

    <div class="icon">
        ✓
    </div>

    <h1>Presensi Berhasil</h1>

    <div class="success">
        Anda berhasil melakukan presensi.
    </div>

    <div class="info">

        <p>
            <strong>Nama:</strong><br>
            {{ $mahasiswa->nama }}
        </p>

        <p>
            <strong>NIM:</strong><br>
            {{ $mahasiswa->nim }}
        </p>

        <p>
            <strong>Mata Kuliah:</strong><br>
            {{ $sesi->kelas->mataKuliah->nama }}
        </p>

        <p>
            <strong>Kelas:</strong><br>
            {{ $sesi->kelas->nama_kelas }}
        </p>

        <p>
            <strong>Dosen:</strong><br>
            {{ $sesi->kelas->dosen->nama }}
        </p>

        <p>
            <strong>Waktu:</strong><br>
            {{ now()->format('d-m-Y H:i:s') }}
        </p>

    </div>

    <div class="status">
        {{ strtoupper($status) }}
    </div>

</div>

</body>
</html>