<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\Hash;

class UserExport implements FromCollection, WithMapping, WithHeadings
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
        return [
            $user->name,
            $user->email,
            $password,
            $user->role,
        ];
    }
}
