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
                'start_at' => '2026-10-05 09:00:00',
                'end_at' => '2026-10-05 12:00:00',
                'location' => 'Lab Komputer 1',
                'capacity' => 30,
                'category' => 'Workshop',
                'status' => 'draft',
            ],
            [
                'code' => 'SM-001',
                'title' => 'Seminar Web Quality',
                'description' => 'Pengenalan maintainability dan testing.',
                'start_at' => '2026-10-12 09:00:00',
                'end_at' => null,
                'location' => null,
                'capacity' => null,
                'category' => 'Seminar',
                'status' => 'draft',
            ],
            [
                'code' => 'PR-001',
                'title' => 'Latihan Laravel Routing',
                'description' => 'Praktik route dan controller.',
                'start_at' => '2026-09-21 09:00:00',
                'end_at' => '2026-09-21 12:00:00',
                'location' => 'Lab Komputer 2',
                'capacity' => 25,
                'category' => 'Praktikum',
                'status' => 'published',
            ],
            [
                'code' => 'KL-001',
                'title' => 'Kuliah Umum HTML CSS',
                'description' => 'Ulasan dasar struktur dan gaya halaman.',
                'start_at' => '2026-09-01 09:00:00',
                'end_at' => '2026-09-01 11:00:00',
                'location' => 'Aula',
                'capacity' => 100,
                'category' => 'Kuliah',
                'status' => 'completed',
            ],
            [
                'code' => 'DS-001',
                'title' => 'Diskusi JavaScript DOM',
                'description' => 'Ulasan event dan manipulasi DOM.',
                'start_at' => '2026-09-10 13:00:00',
                'end_at' => '2026-09-10 15:00:00',
                'location' => 'Ruang Diskusi',
                'capacity' => 20,
                'category' => 'Diskusi',
                'status' => 'completed',
            ],
        ];
        foreach($activities as $item){
            $item['category_id'] = $categoryId[$item['category']];
            unset($item['category']);
            Activity::create($item);
        }
        $categoryIds = $categoryId->values();
        $statuses = ['draft', 'published', 'completed'];

        for ($i = 1; $i <= 12; $i++) {
            $start = now()->subDays(20)->addDays($i * 4)->setTime(9, 0);
            Activity::create([
                'category_id' => $categoryIds[$i % $categoryIds->count()],
                'code' => sprintf('EX-%03d', $i),
                'title' => "Pelatihan Contoh {$i}",
                'description' => 'Data contoh untuk uji pencarian dan filter.',
                'start_at' => $start,
                'end_at' => $start->copy()->addHours(2),
                'location' => 'Ruang Contoh',
                'capacity' => 30,
                'status' => $statuses[$i % 3],
            ]);
        }
    }
}
