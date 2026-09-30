<?php

namespace Database\Seeders;

use App\Models\Activity;
use App\Models\Category;
use Illuminate\Database\Seeder;

class ActivitySeeder extends Seeder
{
    public function run(): void
    {
        $categoryId = Category::pluck('id', 'name');
        $activities = [
            [
                'code' => 'WS-001',
                'title' => 'Workshop Git Dasar',
                'description' => 'Latihan kolaborasi repository.',
                'activity_date' => '2026-10-05',
                'category' => 'Workshop',
                'status' => 'draft',
            ],
            [
                'code' => 'SM-001',
                'title' => 'Seminar Web Quality',
                'description' => 'Pengenalan maintainability dan testing.',
                'activity_date' => '2026-10-12',
                'category' => 'Seminar',
                'status' => 'draft',
            ],
            [
                'code' => 'PR-001',
                'title' => 'Latihan Laravel Routing',
                'description' => 'Praktik route dan controller.',
                'activity_date' => '2026-09-21',
                'category' => 'Praktikum',
                'status' => 'published',
            ],
            [
                'code' => 'KL-001',
                'title' => 'Kuliah Umum HTML CSS',
                'description' => 'Ulasan dasar struktur dan gaya halaman.',
                'activity_date' => '2026-09-01',
                'category' => 'Kuliah',
                'status' => 'completed',
            ],
            [
                'code' => 'DS-001',
                'title' => 'Diskusi JavaScript DOM',
                'description' => 'Ulasan event dan manipulasi DOM.',
                'activity_date' => '2026-09-10',
                'category' => 'Diskusi',
                'status' => 'completed',
            ],
        ];
        foreach($activities as $item){
            Activity::create([
                'category_id' => $categoryId[$item['category']],
                'code' => $item['code'],
                'title' => $item['title'],
                'description' => $item['description'],
                'activity_date' => $item['activity_date'],
                'status' => $item['status'],
            ]);
        }
    }
}
