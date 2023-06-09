<?php

namespace Database\Seeders;


use App\Models\Education;
use Illuminate\Database\Seeder;

class EducationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $educations = [
            'Высшее образование',
            'Среднее образование',
            'Среднее специальное образование',
            'Профессиональные курсы',
            'Сертификации',
        ];

        foreach ($educations as $education) {
            Education::query()->updateOrCreate(['name' => $education]);
        }
    }
}
