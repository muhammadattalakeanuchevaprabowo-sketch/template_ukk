<?php

namespace App\Exports;

use App\Models\Item;
use Maatwebsite\Excel\Concerns\FromCollection;

class LendingExport implements FromCollection
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
        return [
            $lending->name,
            $lending->user->name,
            $lending->item->name,
            $lending->description,
            $lending->amount_borrowed,
            $lending->status,
            $lending->created_at->format('M d, Y'),
            $lending->returned_at ? $lending->returned_at->format('M d, Y') : '-',
        ];
    }
}
