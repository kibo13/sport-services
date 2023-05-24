<?php

namespace Database\Seeders;


use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // seeders
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            ServiceSeeder::class,
            BenefitSeeder::class,
            SpecializationSeeder::class,
            TrainerSeeder::class,
        ]);

        // factories
        User::factory(30)->create();
    }
}
