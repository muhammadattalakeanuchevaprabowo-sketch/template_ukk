<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Division;

class DivisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Division::create(['name' => 'Keamanan']);
        Division::create(['name' => 'Kebersihan']);
        Division::create(['name' => 'Keuangan']);
        Division::create(['name' => 'Kesehatan']);
    }
}
