<?php
namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\FromCollection;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\IOFactory;
use App\Models\SerahTerima;

class SerahTerimaExport implements FromArray, WithEvents
{
    public function array(): array
    {
        // Data yang akan diekspor ke Excel
        return [
            ['Name', 'Email'],
            ['John Doe', 'john@example.com'],
            ['Jane Doe', 'jane@example.com'],
        ];
    }

    public function registerEvents(): array
{
    return [
        AfterSheet::class => function(AfterSheet $event) {
            // Load template Excel
            $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xlsx');
            $spreadsheet = $reader->load(storage_path('app/templates/tes.xlsx'));

            // Get active sheet
            $sheet = $spreadsheet->getActiveSheet();

            // Define starting row and column for data
            $startRow = 2; // Data dimulai dari baris kedua (baris pertama mungkin berisi header)
            $startColumn = 'A'; // Data dimulai dari kolom A

            // Copy data from template to exported sheet
            $data = [
                ['Data 1', 'Data 2', 'Data 3'], // Contoh data baru
                ['Data 4', 'Data 5', 'Data 6'], // Contoh data baru lainnya
                // Tambahkan data baru lainnya sesuai kebutuhan
            ];

            foreach ($data as $rowData) {
                $col = $startColumn;
                foreach ($rowData as $cellData) {
                    $event->sheet->setCellValue($col . $startRow, $cellData);
                    $col++;
                }
                $startRow++;
            }

            // Set layout
            $event->sheet->getStyle('A1:C1')->applyFromArray([
                'font' => [
                    'bold' => true,
                ]
            ]);
        }
    ];
}

}

