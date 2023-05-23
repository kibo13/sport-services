<?php

namespace Database\Seeders;


use App\Models\Benefit;
use Illuminate\Database\Seeder;

class BenefitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $benefits = [
            [
                'name'     => 'Дети до 7 лет',
                'discount' => 1,
            ],
            [
                'name'     => 'Пенсионеры',
                'discount' => 0.5,
            ],
            [
                'name'     => 'Военные, ветераны ВОВ',
                'discount' => 0.3,
            ]
        ];

        foreach ($benefits as $benefit) {
            Benefit::query()->updateOrCreate($benefit);
        }
    }
}
