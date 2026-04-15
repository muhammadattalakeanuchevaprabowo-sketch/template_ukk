<?php

namespace App\Exports;

use App\Models\Item;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Carbon\Carbon;

class ItemExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Item::all();
    }

    public function headings(): array
    {
        return [
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
        return [
            $item->name,
            $item->category->name,
            $item->total,
            $item->getavailableAttribute(),
            $item->broke_count == 0 ? '-' : $item->broke_count,
            $item->lendings()->where('status', 'borrowed')->sum('amount_borrowed'),
            Carbon::parse($item->updated_at)->format('M d, Y'),
        ];
    }
}
