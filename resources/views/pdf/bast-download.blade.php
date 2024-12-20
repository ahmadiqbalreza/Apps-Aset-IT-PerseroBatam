<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Berita Acara Serah Terima Aset</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .header {
            text-align: center;
        }

        .header img {
            width: 160px;
            /* Ukuran logo */
            height: auto;
            margin-bottom: 10px;
            /* Memberikan jarak antara logo dan teks */
        }

        .header h5,
        .header h3,
        .header p {
            margin: 0;
            padding: 0;
        }

        hr {
            border: 0;
            border-top: 2px solid black;
            /* Warna dan ketebalan garis */
            width: 100%;
            /* Lebar garis */
            margin-top: 10px;
            margin-bottom: 10px;
            margin-left: auto;
            margin-right: auto;
            /* Membuat garis berada di tengah */
        }

        .table-container {
            margin-top: 20px;
            width: 100%;
            border-collapse: collapse;
        }

        .table-container th,
        .table-container td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }

        .note {
            font-size: 14px;
        }

        .signatures {
            margin-top: 40px;
            margin-bottom: 40px;
            width: 100%;
            text-align: center;
        }

        .signature {
            display: inline-block;
            width: 40%;
            text-align: center;
            margin: 0 20px;
            position: relative;
        }

        .signature p {
            margin: 0;
        }

        .signature .name,
        .signature .position {
            position: absolute;
            width: 100%;
            text-align: center;
        }

        .signature .name {
            top: 0;
        }

        .signature .line {
            border-top: 1px solid black;
            width: 60%;
            margin-top: 5px;
            margin-bottom: 5px;
            margin-left: auto;
            margin-right: auto;
        }

        .signature .position {
            bottom: 0;
        }
    </style>
</head>

<body>
    <div class="header">
        <!-- Tambahkan logo di sini -->
        <img src="{{ url('/images/logopersero.png') }}" alt="Logo">
        <h5>PT. Pengusahaan Daerah Industri Pulau Batam</h5>
        <h3>BERITA ACARA SERAH TERIMA ASET</h3>
        <p>Nomor: {{ $data->nomor_bast }}</p>
        <hr>
    </div>
    <p>Pada hari ini <strong>[HARI]</strong>, tanggal <strong>[TANGGAL]</strong>, telah dilakukan serah terima aset IT
        dari <strong>{{ $data->asal_aset }}</strong> ke <strong>{{ $data->tujuan_aset }}</strong> sebagai berikut:
    </p>

    <table class="table-container">
        <thead>
            <tr>
                <th>No</th>
                <th>No.Inventaris</th>
                <th>Jenis</th>
                <th>Jumlah</th>
                <th>Merk</th>
                <th>Penerima</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>{{ $data->nomor_inventaris }}</td>
                <td>Laptop</td>
                <td>1</td>
                <td>Asus Tuf Gaming Core i5 RAM 8GB SSD 512GB</td>
                <td>Andi</td>
            </tr>
        </tbody>
    </table>

    <div class="note">
        <p><strong>Note:</strong></p>
        <ul>
            <li>Perangkat ini merupakan milik perusahaan, apabila terjadi kerusakan, menjadi tanggung jawab pengguna.
            </li>
            <li>Apabila masa kerja berakhir, perangkat ini harus dikembalikan sesuai kebijakan perusahaan tanpa
                pengecualian.</li>
        </ul>
    </div>

    <br><br><br>

    <div class="signatures">
        <div class="signature">
            <p><strong>Yang Menyerahkan</strong></p>
            <br><br><br><br><br>
            <p>{{ $data->yang_menyerahkan }}</p>
            <div class="line"></div>
            <p>{{ $data->jabatan_yang_menyerahkan }}</p>
        </div>
        <div class="signature">
            <p><strong>Diterima oleh</strong></p>
            <br><br><br><br><br>
            <p>{{ $data->yang_menerima }}</p>
            <div class="line"></div>
            <p>{{ $data->jabatan_yang_menerima }}</p>
        </div>
        <div class="signature">
            <p><strong>Mengetahui</strong></p>
            <br><br><br><br><br>
            <p>MUHAMMAD ALI</p>
            <div class="line"></div>
            <p>MANAGER IT</p>
        </div>
    </div>
</body>

</html>
