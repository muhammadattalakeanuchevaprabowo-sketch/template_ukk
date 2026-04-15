<?php

namespace App\Exports;

use App\Models\Item;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeSheet;
use Carbon\Carbon;

class ItemExport implements FromCollection, WithHeadings, WithMapping, WithEvents
{
    public function collection()
    {
        return Item::all();
    }

    public function headings(): array
    {
        return [
            'No',
            'Name',
            'Category',
            'Total',
            'Available',
            'Broke Items',
            'Amount Borrowed',
            'Last Updated'
        ];
    }

    public function map($item): array
    {
        static $no = 0;
        $no++;

        return [
            $no,
            $item->name,
            $item->category->name,
            $item->total,
            $item->getavailableAttribute(),
            $item->broke_count == 0 ? '-' : $item->broke_count,
            $item->lendings()->where('status', 'borrowed')->sum('amount_borrowed'),
            Carbon::parse($item->updated_at)->format('M d, Y'),
        ];
    }

    public function registerEvents(): array
    {
        return [
            BeforeSheet::class => function(BeforeSheet $event) {
                $sheet = $event->sheet->getDelegate();

                // Tulis judul di baris 1
                $sheet->setCellValue('A1', 'Data Item');

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
