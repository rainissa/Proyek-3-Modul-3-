<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $names = ['Workshop', 'Seminar', 'Praktikum', 'Kuliah','Diskusi', 'Lomba'];
        foreach($names as $name){
            Category::create([
                'name' => $name,
                'slug' => strtolower($name),
            ]);
        }
    }
}
