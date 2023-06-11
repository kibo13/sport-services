<?php

namespace Database\Seeders;


use App\Models\Option;
use Illuminate\Database\Seeder;

class OptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $options = [
            [
                'section' => 'payments',
                'comment' => 'Настройка начального номера платежа'
            ]
        ];

        foreach ($options as $option) {
            Option::query()->updateOrCreate(['section' => $option['section']], $option);
        }
    }
}
