<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Presensi Mahasiswa</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f8;
            margin: 0;
            padding: 30px 15px;
        }

        .card {
            max-width: 450px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,.1);
        }

        h1 {
            text-align: center;
        }

        .info {
            background: #f1f5f9;
            padding: 15px;
            border-radius: 10px;
            margin: 20px 0;
        }

        input {
            width: 100%;
            box-sizing: border-box;
            padding: 14px;
            margin-top: 8px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 16px;
        }

        button {
            width: 100%;
            padding: 14px;
            margin-top: 20px;
            border: none;
            border-radius: 8px;
            background: #111827;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }

        .error {
            background: #fee2e2;
            color: #991b1b;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 15px;
        }

        .success {
            background: #dcfce7;
            color: #166534;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 15px;
        }
    </style>
</head>

<body>

<div class="card">

    <h1>Presensi</h1>

    <div class="info">
        <strong>{{ $sesi->kelas->mataKuliah->nama ?? '-' }}</strong>

        <br><br>

        Kelas:
        {{ $sesi->kelas->nama_kelas ?? '-' }}

        <br>

        Dosen:
        {{ $sesi->kelas->dosen->nama ?? '-' }}
    </div>

    @if(session('error'))
        <div class="error">
            {{ session('error') }}
        </div>
    @endif

    @if($errors->any())
        <div class="error">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST"
          action="{{ route('presensi.store', $sesi->kode_qr) }}">

        @csrf

        <label>
            <strong>NIM Mahasiswa</strong>
        </label>

        <input
            type="text"
            name="nim"
            placeholder="Masukkan NIM"
            required
            autofocus
        >

        <button type="submit">
            ABSEN SEKARANG
        </button>

    </form>

</div>

</body>
</html>