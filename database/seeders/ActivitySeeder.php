<?php

namespace Database\Seeders;

use App\Models\Activity;
use Illuminate\Database\Seeder;

class ActivitySeeder extends Seeder
{
    public function run(): void
    {
        Activity::query()->insert([
            [
                'title' => 'Workshop Git Dasar',
                'description' => 'Latihan dasar penggunaan Git dan repository.',
                'activity_date' => '2026-10-05',
                'category' => 'Workshop',
                'status' => 'Planned',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Seminar Web Quality',
                'description' => 'Pengenalan kualitas dan maintainability aplikasi web.',
                'activity_date' => '2026-10-12',
                'category' => 'Seminar',
                'status' => 'Planned',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Pelatihan Laravel Dasar',
                'description' => 'Belajar route, controller, model, dan Blade.',
                'activity_date' => '2026-10-18',
                'category' => 'Pelatihan',
                'status' => 'Ongoing',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Diskusi Proyek Web',
                'description' => 'Diskusi perkembangan proyek mahasiswa.',
                'activity_date' => '2026-10-21',
                'category' => 'Diskusi',
                'status' => 'Ongoing',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Pengenalan HTML CSS',
                'description' => 'Kegiatan pengenalan dasar HTML dan CSS.',
                'activity_date' => '2026-09-15',
                'category' => 'Workshop',
                'status' => 'Done',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
