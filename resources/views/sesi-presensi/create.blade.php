<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Sesi Presensi</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f3f4f6;
        }

        .container {
            max-width: 700px;
            margin: 50px auto;
            padding: 20px;
        }

        .card {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,.08);
        }

        h1 {
            margin-bottom: 25px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        select,
        input,
        button {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border-radius: 8px;
            border: 1px solid #d1d5db;
            font-size: 15px;
        }

        button {
            background: #111827;
            color: white;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background: #1f2937;
        }
    </style>
</head>

<body>

<div class="container">

    <div class="card">

        <h1>📱 Buat Sesi Presensi</h1>

        <form action="{{ route('sesi-presensi.store') }}" method="POST">
            @csrf

            <label for="kelas_id">Pilih Kelas</label>

            <select name="kelas_id" id="kelas_id" required>

                <option value="">-- Pilih Kelas --</option>

                @foreach ($kelas as $item)
                    <option value="{{ $item->id }}">
                        {{ $item->nama_kelas }}
                        -
                        {{ $item->mataKuliah->nama ?? 'Mata Kuliah' }}
                    </option>
                @endforeach

            </select>

            <label for="durasi">Durasi Presensi</label>

            <select name="durasi" id="durasi" required>
                <option value="5">5 menit</option>
                <option value="10">10 menit</option>
                <option value="15" selected>15 menit</option>
                <option value="30">30 menit</option>
                <option value="60">60 menit</option>
            </select>

            <button type="submit">
                Buat Sesi & Tampilkan QR
            </button>

        </form>

    </div>

</div>

</body>
</html>