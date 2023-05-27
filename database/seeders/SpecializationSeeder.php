<?php

namespace Database\Seeders;


use App\Models\Specialization;
use Illuminate\Database\Seeder;

class SpecializationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $specializations = [
            [
                'name' => 'Плавание',
                'note' => 'Перемещение в воде с использованием различных техник движения'
            ],
            [
                'name' => 'Тяжёлая атлетика',
                'note' => 'Подъем и перемещение тяжелых весов для развития силы и выносливости'
            ],
            [
                'name' => 'Теннис',
                'note' => 'Удары мяча ракеткой через сетку в индивидуальной или командной игре'
            ],
        ];

        foreach ($specializations as $specialization) {
            Specialization::query()->updateOrCreate(['name' => $specialization['name']], $specialization);
        }
    }
}
