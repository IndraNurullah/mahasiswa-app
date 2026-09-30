<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Import Mahasiswa</title>
</head>
<body>

    <h1>Import Data Mahasiswa</h1>

    @if (session('success'))
        <div>
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('mahasiswa.import') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div>
            <label for="file">Pilih File Excel / CSV:</label>
            <input
                type="file"
                name="file"
                id="file"
                accept=".xlsx,.xls,.csv"
                required
            >
        </div>

        <br>

        <button type="submit">
            Import Data
        </button>
    </form>

</body>
</html>
