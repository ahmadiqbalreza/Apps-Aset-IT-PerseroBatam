<?php

namespace App\Imports;

use App\Models\Aset;
use Maatwebsite\Excel\Concerns\ToModel;

class AsetImport implements ToModel
{
    public function model(array $row)
    {
        return new Aset([
            'nomor_urut' => $row[2],
            'slug_aset' => $row[3],
            'nomor_inventaris' => $row[4],
            'bulan' => $row[5],
            'tahun' => $row[6],
            'jenis_id' => $row[7],
            'merek' => $row[8],
            'processor' => $row[9],
            'ram' => $row[10],
            'hdd' => $row[11],
            'user' => $row[12],
            'unit_id' => $row[13],
            'lokasi_id' => $row[14],
            'status' => $row[15],
            // tambahkan field lainnya sesuai kebutuhan
        ]);
    }
}
