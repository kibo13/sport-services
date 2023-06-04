<?php

namespace Database\Seeders;

use App\Models\Activity;
use Illuminate\Database\Seeder;

class ActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $activities = [
            [
                'name'  => 'Плавание',
                'color' => '#4285F4',
            ],
            [
                'name'  => 'Тренажерный зал',
                'color' => '#FFBB33',
            ],
            [
                'name'  => 'Теннисный корт',
                'color' => '#00C851',
            ],
        ];

        foreach ($activities as $activity) {
            Activity::query()->updateOrCreate($activity);
        }
    }
}
