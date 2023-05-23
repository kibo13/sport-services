<?php

namespace Database\Seeders;


use App\Enums\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Faker\Factory as FakerFactory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class TrainerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = FakerFactory::create('ru_RU');

        // Генерация случайных данных для таблицы users
        for ($i = 0; $i < 8; $i++) {
            User::query()->create([
                'role_id'           => Role::INSTRUCTOR,
                'name'              => $faker->firstName(),
                'surname'           => $faker->lastName(),
                'patronymic'        => $faker->firstNameMale(),
                'birthday'          => $faker->dateTimeBetween('-35 years', '-25 years')->format('Y-m-d'),
                'phone'             => $faker->unique()->numerify('771#######'),
                'email'             => $faker->unique()->safeEmail(),
                'address'           => $faker->address(),
                'email_verified_at' => now(),
                'password'          => Hash::make('secret'),
                'remember_token'    => Str::random(10),
            ]);
        }
    }
}
