<?php

namespace App\Exports;

use App\Models\Aset;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;


class AsetExport implements WithStyles, FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{
    use Exportable;

    protected $fields;

    public function __construct($fields)
    {
        $this->fields = $fields;
    }

    public function collection()
    {
        return Aset::all($this->fields);
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text, size 13, and centered horizontally.
            1 => [
                'font' => ['bold' => true, 'size' => 13],
                'alignment' => ['horizontal' => 'center'],
            ],
            'A' => [
                'alignment' => ['horizontal' => 'center'],
            ],
            'B' => [
                'alignment' => ['horizontal' => 'center'],
            ],
            'C' => [
                'alignment' => ['horizontal' => 'center'],
            ],
        ];
    }

    public function map($Aset): array
    {
        return [
            $Aset->nomor_urut,
            $Aset->slug_aset,
            $Aset->nomor_inventaris,
            $Aset->bulan,
            $Aset->tahun,
            $Aset->jenis->nama_jenis,
            $Aset->merek,
            $Aset->processor,
            $Aset->ram,
            $Aset->hdd,
            $Aset->pengguna,
            $Aset->unit->nama_unit,
            $Aset->lokasi->nama_lokasi,
            $Aset->status
        ];
    }

    public function headings(): array
    {
        return [
            'Nomor Urut',
            'Slug',
            'Nomor Iventaris',
            'Bulan',
            'Tahun',
            'Jenis',
            'Merek',
            'Processor',
            'RAM',
            'HDD',
            'User',
            'Unit',
            'Lokasi',
            'Status'
            // tambahkan field lainnya sesuai kebutuhan
        ];
    }
}
