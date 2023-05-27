<?php

namespace Database\Seeders;


use Database\Factories\ClientFactory;
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
            AdminSeeder::class,
            PermissionSeeder::class,
            PermissionUserSeeder::class,
            ServiceSeeder::class,
            BenefitSeeder::class,
            SpecializationSeeder::class,
            TrainerSeeder::class,
        ]);

        // factories
        ClientFactory::new()->count(30)->create();
    }
}
