<?php

namespace App\Exports;

use App\Models\Lending;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeSheet;

class LendingExport implements FromCollection, WithHeadings, WithMapping, WithEvents
{
    public function collection()
    {
        return Lending::with('user', 'item')->get();
    }

    public function headings(): array
    {
        return [
            'No',
            'Name',
            'Staff',
            'Item',
            'Description',
            'Amount Borrowed',
            'Status',
            'Borrowed At',
            'Returned At',
        ];
    }

    public function map($lending): array
    {
        static $no = 0;
        $no++;

        return [
            $no,
            $lending->name,
            $lending->user->name,
            $lending->item->name,
            $lending->description,
            $lending->amount_borrowed,
            $lending->status,
            $lending->created_at->locale('id')->translatedFormat('d/m/Y H:i'),
            $lending->returned_at ? $lending->returned_at->locale('id')->translatedFormat('d/m/Y H:i') : '-',
        ];
    }

    public function registerEvents(): array
    {
        return [
            BeforeSheet::class => function(BeforeSheet $event) {
                $sheet = $event->sheet->getDelegate();

                // Tulis judul di baris 1
                $sheet->setCellValue('A1', 'Data Lending');

                // Style judul (bold, merge cells)
                $sheet->mergeCells('A1:G1');
                $sheet->getStyle('A1')->getFont()->setBold(true);
                $sheet->getStyle('A1')->getFont()->setSize(14);

                // Insert empty row setelah title
                $sheet->insertNewRowBefore(2);
            },
        ];
    }
}
