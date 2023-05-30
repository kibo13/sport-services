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
                'name'     => 'Категория 1',
                'discount' => 0.15,
            ],
            [
                'name'     => 'Категория 2',
                'discount' => 0.25,
            ],
            [
                'name'     => 'Категория 3',
                'discount' => 0.35,
            ]
        ];

        foreach ($benefits as $benefit) {
            Benefit::query()->updateOrCreate($benefit);
        }
    }
}
