<?php

namespace Database\Seeders;

use App\Models\Activity;
use Illuminate\Database\Seeder;

class ActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Activity::query()->insert(
            [
                [
                    'title' => 'Workshop Git Dasar',
                    'description' => 'Latihan kolaborasi repository.',
                    'activity_date' => '2026-10-05',
                    'category' => 'Workshop',
                    'status' => 'Planned',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'title' => 'Seminar Web Quality',
                    'description' => 'Pengenalan maintainability dan testing.',
                    'activity_date' => '2026-10-12',
                    'category' => 'Seminar',
                    'status' => 'Planned',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'title' => 'Latihan Laravel Routing',
                    'description' => 'Praktik route dan controller.',
                    'activity_date' => '2026-09-21',
                    'category' => 'Praktikum',
                    'status' => 'Ongoing',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'title' => 'Kuliah Umum HTML CSS',
                    'description' => 'Ulasan dasar struktur dan gaya halaman.',
                    'activity_date' => '2026-09-01',
                    'category' => 'Kuliah',
                    'status' => 'Done',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'title' => 'Diskusi JavaScript DOM',
                    'description' => 'Ulasan event dan manipulasi DOM.',
                    'activity_date' => '2026-09-10',
                    'category' => 'Diskusi',
                    'status' => 'Done',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ]);
    }
}
