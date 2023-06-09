<?php

namespace Database\Seeders;


use App\Enums\Activity;
use App\Enums\Service\ServiceCategory;
use App\Enums\Service\ServiceType;
use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $services = [

            // Плавание
            [
                'name'        => ServiceType::NAMES[ServiceType::TICKET],
                'type_id'     => ServiceType::TICKET,
                'activity_id' => Activity::SWIMMING,
                'category_id' => ServiceCategory::KID,
                'unit'        => ServiceType::UNITS[ServiceType::TICKET],
                'price'       => 70,
            ],
            [
                'name'        => ServiceType::NAMES[ServiceType::TICKET],
                'type_id'     => ServiceType::TICKET,
                'activity_id' => Activity::SWIMMING,
                'category_id' => ServiceCategory::STUDENT,
                'unit'        => ServiceType::UNITS[ServiceType::TICKET],
                'price'       => 107,
            ],
            [
                'name'        => ServiceType::NAMES[ServiceType::TICKET],
                'type_id'     => ServiceType::TICKET,
                'activity_id' => Activity::SWIMMING,
                'category_id' => ServiceCategory::ADULT,
                'unit'        => ServiceType::UNITS[ServiceType::TICKET],
                'price'       => 134,
            ],
            [
                'name'        => ServiceType::NAMES[ServiceType::PASS],
                'type_id'     => ServiceType::PASS,
                'activity_id' => Activity::SWIMMING,
                'category_id' => ServiceCategory::KID,
                'unit'        => ServiceType::UNITS[ServiceType::PASS],
                'price'       => 700,
            ],
            [
                'name'        => ServiceType::NAMES[ServiceType::PASS],
                'type_id'     => ServiceType::PASS,
                'activity_id' => Activity::SWIMMING,
                'category_id' => ServiceCategory::STUDENT,
                'unit'        => ServiceType::UNITS[ServiceType::PASS],
                'price'       => 1070,
            ],
            [
                'name'        => ServiceType::NAMES[ServiceType::PASS],
                'type_id'     => ServiceType::PASS,
                'activity_id' => Activity::SWIMMING,
                'category_id' => ServiceCategory::ADULT,
                'unit'        => ServiceType::UNITS[ServiceType::PASS],
                'price'       => 1340,
            ],
            [
                'name'        => ServiceType::NAMES[ServiceType::GROUP],
                'type_id'     => ServiceType::GROUP,
                'activity_id' => Activity::SWIMMING,
                'category_id' => ServiceCategory::KID,
                'unit'        => ServiceType::UNITS[ServiceType::GROUP],
                'price'       => 800,
            ],
            [
                'name'        => ServiceType::NAMES[ServiceType::GROUP],
                'type_id'     => ServiceType::GROUP,
                'activity_id' => Activity::SWIMMING,
                'category_id' => ServiceCategory::STUDENT,
                'unit'        => ServiceType::UNITS[ServiceType::GROUP],
                'price'       => 1200,
            ],
            [
                'name'        => ServiceType::NAMES[ServiceType::GROUP],
                'type_id'     => ServiceType::GROUP,
                'activity_id' => Activity::SWIMMING,
                'category_id' => ServiceCategory::ADULT,
                'unit'        => ServiceType::UNITS[ServiceType::GROUP],
                'price'       => 1500,
            ],

            // Тренажерный зал
            [
                'name'        => ServiceType::NAMES[ServiceType::TICKET],
                'type_id'     => ServiceType::TICKET,
                'activity_id' => Activity::GYM,
                'category_id' => ServiceCategory::KID,
                'unit'        => ServiceType::UNITS[ServiceType::TICKET],
                'price'       => 70,
            ],
            [
                'name'        => ServiceType::NAMES[ServiceType::TICKET],
                'type_id'     => ServiceType::TICKET,
                'activity_id' => Activity::GYM,
                'category_id' => ServiceCategory::STUDENT,
                'unit'        => ServiceType::UNITS[ServiceType::TICKET],
                'price'       => 84,
            ],
            [
                'name'        => ServiceType::NAMES[ServiceType::TICKET],
                'type_id'     => ServiceType::TICKET,
                'activity_id' => Activity::GYM,
                'category_id' => ServiceCategory::ADULT,
                'unit'        => ServiceType::UNITS[ServiceType::TICKET],
                'price'       => 105,
            ],
            [
                'name'        => ServiceType::NAMES[ServiceType::PASS],
                'type_id'     => ServiceType::PASS,
                'activity_id' => Activity::GYM,
                'category_id' => ServiceCategory::KID,
                'unit'        => ServiceType::UNITS[ServiceType::PASS],
                'price'       => 700,
            ],
            [
                'name'        => ServiceType::NAMES[ServiceType::PASS],
                'type_id'     => ServiceType::PASS,
                'activity_id' => Activity::GYM,
                'category_id' => ServiceCategory::STUDENT,
                'unit'        => ServiceType::UNITS[ServiceType::PASS],
                'price'       => 840,
            ],
            [
                'name'        => ServiceType::NAMES[ServiceType::PASS],
                'type_id'     => ServiceType::PASS,
                'activity_id' => Activity::GYM,
                'category_id' => ServiceCategory::ADULT,
                'unit'        => ServiceType::UNITS[ServiceType::PASS],
                'price'       => 1050,
            ],
            [
                'name'        => ServiceType::NAMES[ServiceType::GROUP],
                'type_id'     => ServiceType::GROUP,
                'activity_id' => Activity::GYM,
                'category_id' => ServiceCategory::KID,
                'unit'        => ServiceType::UNITS[ServiceType::GROUP],
                'price'       => 800,
            ],
            [
                'name'        => ServiceType::NAMES[ServiceType::GROUP],
                'type_id'     => ServiceType::GROUP,
                'activity_id' => Activity::GYM,
                'category_id' => ServiceCategory::STUDENT,
                'unit'        => ServiceType::UNITS[ServiceType::GROUP],
                'price'       => 960,
            ],
            [
                'name'        => ServiceType::NAMES[ServiceType::GROUP],
                'type_id'     => ServiceType::GROUP,
                'activity_id' => Activity::GYM,
                'category_id' => ServiceCategory::ADULT,
                'unit'        => ServiceType::UNITS[ServiceType::GROUP],
                'price'       => 1200,
            ],

            // Теннисный корт
            [
                'name'        => ServiceType::NAMES[ServiceType::TICKET],
                'type_id'     => ServiceType::TICKET,
                'activity_id' => Activity::TENNIS,
                'category_id' => ServiceCategory::KID,
                'unit'        => ServiceType::UNITS[ServiceType::TICKET],
                'price'       => 70,
            ],
            [
                'name'        => ServiceType::NAMES[ServiceType::TICKET],
                'type_id'     => ServiceType::TICKET,
                'activity_id' => Activity::TENNIS,
                'category_id' => ServiceCategory::STUDENT,
                'unit'        => ServiceType::UNITS[ServiceType::TICKET],
                'price'       => 104,
            ],
            [
                'name'        => ServiceType::NAMES[ServiceType::TICKET],
                'type_id'     => ServiceType::TICKET,
                'activity_id' => Activity::TENNIS,
                'category_id' => ServiceCategory::ADULT,
                'unit'        => ServiceType::UNITS[ServiceType::TICKET],
                'price'       => 130,
            ],
            [
                'name'        => ServiceType::NAMES[ServiceType::PASS],
                'type_id'     => ServiceType::PASS,
                'activity_id' => Activity::TENNIS,
                'category_id' => ServiceCategory::KID,
                'unit'        => ServiceType::UNITS[ServiceType::PASS],
                'price'       => 700,
            ],
            [
                'name'        => ServiceType::NAMES[ServiceType::PASS],
                'type_id'     => ServiceType::PASS,
                'activity_id' => Activity::TENNIS,
                'category_id' => ServiceCategory::STUDENT,
                'unit'        => ServiceType::UNITS[ServiceType::PASS],
                'price'       => 1040,
            ],
            [
                'name'        => ServiceType::NAMES[ServiceType::PASS],
                'type_id'     => ServiceType::PASS,
                'activity_id' => Activity::TENNIS,
                'category_id' => ServiceCategory::ADULT,
                'unit'        => ServiceType::UNITS[ServiceType::PASS],
                'price'       => 1300,
            ],
            [
                'name'        => ServiceType::NAMES[ServiceType::GROUP],
                'type_id'     => ServiceType::GROUP,
                'activity_id' => Activity::TENNIS,
                'category_id' => ServiceCategory::KID,
                'unit'        => ServiceType::UNITS[ServiceType::GROUP],
                'price'       => 800,
            ],
            [
                'name'        => ServiceType::NAMES[ServiceType::GROUP],
                'type_id'     => ServiceType::GROUP,
                'activity_id' => Activity::TENNIS,
                'category_id' => ServiceCategory::STUDENT,
                'unit'        => ServiceType::UNITS[ServiceType::GROUP],
                'price'       => 1200,
            ],
            [
                'name'        => ServiceType::NAMES[ServiceType::GROUP],
                'type_id'     => ServiceType::GROUP,
                'activity_id' => Activity::TENNIS,
                'category_id' => ServiceCategory::ADULT,
                'unit'        => ServiceType::UNITS[ServiceType::GROUP],
                'price'       => 1450,
            ],
        ];

        foreach ($services as $service) {
            Service::query()->updateOrCreate($service);
        }
    }
}
