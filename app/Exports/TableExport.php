<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Illuminate\Contracts\View\View;
use App\Models\Feedback;

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
                $event->sheet->getDelegate()->getColumnDimension('A')->setWidth(60);
                $event->sheet->getDelegate()->getColumnDimension('B')->setWidth(10);
                $event->sheet->getDelegate()->getColumnDimension('c')->setWidth(60);
                // Add more columns as needed
            },
        ];
    }
}
