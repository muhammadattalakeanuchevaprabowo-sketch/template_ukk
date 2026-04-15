<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeSheet;

class UserExport implements FromCollection, WithMapping, WithHeadings, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return User::all();
    }

    public function headings(): array
    {
        return [
            'No',
            'Name',
            'Email',
            'Password',
            'Role',
        ];
    }

    public function map($user): array
    {
        $passwordGenerated = substr($user->email, 0, 4) . $user->id;

            if (Hash::check($passwordGenerated, $user->password)) {
                $password = $passwordGenerated;
            } else {
                $password = 'user has changed the password';
            }

            static $no = 0;
            $no++;

        return [
            $no,
            $user->name,
            $user->email,
            $password,
            $user->role,
        ];
    }

    public function registerEvents(): array
    {
        return [
            BeforeSheet::class => function(BeforeSheet $event) {
                $sheet = $event->sheet->getDelegate();

                // Tulis judul di baris 1
                $sheet->setCellValue('A1', 'Data User');

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
