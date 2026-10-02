<?php

namespace Database\Seeders;

use App\Models\Activity;
use App\Models\Category;
use Illuminate\Database\Seeder;

class ActivitySeeder extends Seeder
{
    public function run(): void
    {
        $workshop = Category::where('slug', 'workshop')->firstOrFail();
        $seminar = Category::where('slug', 'seminar')->firstOrFail();
        $pelatihan = Category::where('slug', 'pelatihan')->firstOrFail();

        for ($i = 1; $i <= 15; $i++) {
            $category = match ($i % 3) {
                0 => $workshop,
                1 => $seminar,
                default => $pelatihan,
            };

            $status = match ($i % 3) {
                0 => 'draft',
                1 => 'published',
                default => 'completed',
            };

            Activity::create([
                'category_id' => $category->id,
                'code' => 'ACT-' . str_pad(
                    (string) $i,
                    3,
                    '0',
                    STR_PAD_LEFT
                ),
                'title' => 'Activity ' . $i,
                'description' => 'Data kegiatan untuk Special Challenge.',
                'start_at' => now()->addDays($i),
                'end_at' => now()->addDays($i)->addHours(2),
                'location' => 'Ruang ' . (($i % 5) + 1),
                'capacity' => 20 + $i,
                'status' => $status,
            ]);
        }
    }
}