<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Illuminate\Contracts\View\View;
use App\Models\Feedback;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class TableExport implements FromView, WithEvents
{
    
    public function view(): View
    {
        $exportData = session('export_data');

        return view('admin.export_excel', $exportData);
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                // Adjust the column width for specific columns
                $event->sheet->getDelegate()->getColumnDimension('A')->setWidth(20);
                $event->sheet->getDelegate()->getColumnDimension('B')->setWidth(50);
                $event->sheet->getDelegate()->getColumnDimension('C')->setWidth(10);
                $event->sheet->getDelegate()->getColumnDimension('D')->setWidth(50);
                $event->sheet->getDelegate()->getStyle('A9:D9')->getFont()->setBold(true);
                $event->sheet->getDelegate()->getStyle('A4:A7')->getFont()->setBold(true);
                $event->sheet->getDelegate()->mergeCells('A1:D1');
                $event->sheet->getDelegate()->mergeCells('A2:D2');
                $event->sheet->getDelegate()->getStyle('A1:D1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('A1:D1')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                $event->sheet->getDelegate()->getStyle('A2:D2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('A2:D2')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);


                
                $startRow = 1; // Adjust the starting row as needed
                    $endRow = 100; // Adjust the ending row as needed
                    $column = 'B'; // Adjust the column letter as needed

                    for ($row = $startRow; $row <= $endRow; $row++) {
                        $event->sheet->getDelegate()->getStyle($column . $row)->getAlignment()->setWrapText(true);
                    }

                    $columnD = 'D'; // Adjust the column letter as needed

                    for ($row = $startRow; $row <= $endRow; $row++) {
                        $event->sheet->getDelegate()->getStyle($columnD . $row)->getAlignment()->setWrapText(true);
                    }

                $rows = $event->sheet->getDelegate()->getHighestRow();
                $columns = range('A', 'Z'); // Adjust the range of columns as needed
                
                    foreach ($columns as $column) {
                        for ($row = 1; $row <= $rows; $row++) {
                            $event->sheet->getDelegate()->getStyle($column . $row)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP);
                        }
                    }
                
                    $lastColumn = 'D';
                    $lastRow = 75;
                    $borderStyle = \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN;

                    $range = 'A9:' . $lastColumn . $lastRow;

                    $event->sheet->getDelegate()->getStyle($range)->getBorders()->getAllBorders()->setBorderStyle($borderStyle);

                    
            },
        ];
    }
}
