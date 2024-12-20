<!DOCTYPE html>
<html>

<head>
    <title>Aset IT PT Persero Batam</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table,
        th,
        td {
            border: 1px solid black;
            padding: 8px;
        }

        h2,
        h3 {
            text-align: left;
        }

        h3 {
            margin-top: 40px;
        }

        .header {
            font-weight: bold;
            text-align: center;
        }

        .logo {
            width: 100px;
            height: auto;
        }

        .separator {
            border: none;
            height: 10px;
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
            text-align: center;
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

        .header-content {
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="header">
        <!-- Tambahkan logo di sini -->
        <img src="{{ url('/images/logopersero.png') }}" alt="Logo">
        <h5>PT. Pengusahaan Daerah Industri Pulau Batam</h5>
        <h3>ASET IT PERSERO BATAM</h3>
        <hr>
    </div>
    <p>Urut Berdasarkan: {{ ucfirst($sortir) }}</p>

    @foreach ($groupedData as $key => $items)
        <!-- Header untuk setiap kelompok -->
        <h3>{{ ucfirst($sortir) }}:
            @if ($sortir == 'jenis_id')
                {{ $items->first()->jenis->nama_jenis }}
            @elseif ($sortir == 'tahun')
                {{ $key }}
            @elseif ($sortir == 'unit_id')
                {{ $items->first()->unit->nama_unit }}
            @else
                {{ $items->first()->lokasi->nama_lokasi }}
            @endif
        </h3>

        <!-- Tabel untuk setiap kelompok -->
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nomor Inventaris</th>
                    <th>Jenis Aset</th>
                    <th>Tahun</th>
                    <th>Pengguna</th>
                    <th>Lokasi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->nomor_inventaris }}</td>
                        <td>{{ $item->jenis->nama_jenis }}</td>
                        <td>{{ $item->tahun }}</td>
                        <td>{{ $item->pengguna }}</td>
                        <td>{{ $item->lokasi->nama_lokasi }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Separator -->
        <hr class="separator">
    @endforeach

</body>

</html>
