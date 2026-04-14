<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Hardware', 'Software', 'Network',
            'Printer', 'Email', 'Akses & Hak Akses', 'Lainnya'
        ];

        foreach ($categories as $cat) {
            Category::create(['name' => $cat]);
        }
    }
}