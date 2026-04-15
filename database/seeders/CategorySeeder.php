<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create(['name' => 'Alat Kantor', 'division_id' => 3]);
        Category::create(['name' => 'Alat Kebersihan', 'division_id' => 2]);
        Category::create(['name' => 'Pewangi', 'division_id' => 2]);
        Category::create(['name' => 'Alat Tulis', 'division_id' => 3]);
        Category::create(['name' => 'Obat-obatan', 'division_id' => 4]);
}
}