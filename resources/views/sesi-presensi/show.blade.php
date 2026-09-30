<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>QR Presensi</title>

    <script src="https://cdn.jsdelivr.net/npm/qrcodejs@1.0.0/qrcode.min.js"></script>

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
            font-weight: bold;
            font-size: 19px;
        }

        .back {
            color: #d1d5db;
            text-decoration: none;
            font-size: 14px;
        }

        .container {
            max-width: 850px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .card {
            background: white;
            border-radius: 20px;
            padding: 35px;
            box-shadow: 0 10px 35px rgba(0,0,0,.07);
        }

        .title {
            text-align: center;
        }

        .title h1 {
            margin: 0;
            font-size: 27px;
        }

        .title p {
            color: #6b7280;
            margin-top: 8px;
        }

        .info {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 12px;
            margin: 30px 0;
        }

        .info-box {
            background: #f8fafc;
            border-radius: 12px;
            padding: 15px;
            text-align: center;
        }

        .info-box span {
            display: block;
            color: #6b7280;
            font-size: 12px;
            margin-bottom: 7px;
        }

        .info-box strong {
            font-size: 14px;
        }

        .qr-section {
            text-align: center;
            border-top: 1px solid #e5e7eb;
            padding-top: 30px;
        }

        #qrcode {
            display: flex;
            justify-content: center;
            margin: 25px 0;
        }

        #qrcode img {
            padding: 15px;
            border: 1px solid #e5e7eb;
            border-radius: 15px;
        }

        .status {
            display: inline-block;
            padding: 8px 15px;
            border-radius: 50px;
            background: #dcfce7;
            color: #166534;
            font-size: 13px;
            font-weight: bold;
        }

        .timer {
            font-size: 42px;
            font-weight: bold;
            margin: 15px 0 5px;
            letter-spacing: 2px;
        }

        .timer-label {
            color: #6b7280;
            font-size: 13px;
        }

        .instruction {
            background: #eff6ff;
            color: #1e40af;
            padding: 15px;
            border-radius: 10px;
            margin-top: 25px;
            font-size: 14px;
        }

        .actions {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 25px;
        }

        .button {
            padding: 11px 18px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 13px;
            font-weight: bold;
        }

        .button-dark {
            background: #111827;
            color: white;
        }

        .button-blue {
            background: #2563eb;
            color: white;
        }

        @media(max-width: 650px) {

            .header {
                padding: 16px 20px;
            }

            .container {
                margin: 20px auto;
            }

            .card {
                padding: 22px 17px;
            }

            .info {
                grid-template-columns: 1fr;
            }

            .timer {
                font-size: 35px;
            }

            .actions {
                flex-direction: column;
            }

            .button {
                text-align: center;
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

    <div class="card">

        <div class="title">

            <h1>QR Presensi</h1>

            <p>
                Tampilkan QR Code ini kepada mahasiswa
                untuk melakukan presensi.
            </p>

        </div>


        <div class="info">

            <div class="info-box">

                <span>MATA KULIAH</span>

                <strong>
                    {{ $sesiPresensi->kelas->mataKuliah->nama ?? '-' }}
                </strong>

            </div>


            <div class="info-box">

                <span>KELAS</span>

                <strong>
                    {{ $sesiPresensi->kelas->nama_kelas ?? '-' }}
                </strong>

            </div>


            <div class="info-box">

                <span>DOSEN</span>

                <strong>
                    {{ $sesiPresensi->kelas->dosen->nama ?? '-' }}
                </strong>

            </div>

        </div>


        <div class="qr-section">

            <div class="status" id="status">
                ● PRESENSI AKTIF
            </div>

            <div id="qrcode"></div>

            <div class="timer" id="timer">
                --:--
            </div>

            <div class="timer-label">
                Waktu tersisa
            </div>


            <div class="instruction">

                📱 <strong>Cara Presensi:</strong>

                Mahasiswa scan QR Code →
                masukkan NIM →
                tekan <strong>Absen Sekarang</strong>.

            </div>


            <div class="actions">

                <a
                    href="{{ route('presensi.rekap', $sesiPresensi) }}"
                    class="button button-blue"
                >
                    📊 Lihat Rekap
                </a>

                <a
                    href="{{ route('dashboard') }}"
                    class="button button-dark"
                >
                    ← Dashboard
                </a>

            </div>

        </div>

    </div>

</div>


<script>

    const kodeQR = @json($sesiPresensi->kode_qr);

   const scanUrl =
    "http://192.168.1.16:8000/presensi/scan/" + kodeQR;


    new QRCode(
        document.getElementById("qrcode"),
        {
            text: scanUrl,
            width: 300,
            height: 300
        }
    );


    const berakhir =
        new Date(
            @json($sesiPresensi->berakhir)
        ).getTime();


    function updateTimer() {

        const sekarang =
            new Date().getTime();

        const sisa =
            berakhir - sekarang;


        if (sisa <= 0) {

            document.getElementById("timer")
                .innerHTML = "WAKTU HABIS";

            document.getElementById("status")
                .innerHTML = "● PRESENSI BERAKHIR";

            document.getElementById("status")
                .style.background = "#fee2e2";

            document.getElementById("status")
                .style.color = "#991b1b";

            return;
        }


        const menit =
            Math.floor(sisa / 60000);

        const detik =
            Math.floor(
                (sisa % 60000) / 1000
            );


        document.getElementById("timer")
            .innerHTML =
            String(menit).padStart(2, "0")
            + ":" +
            String(detik).padStart(2, "0");

    }


    updateTimer();

    setInterval(updateTimer, 1000);

</script>

</body>

</html>