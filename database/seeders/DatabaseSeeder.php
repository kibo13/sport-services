<?php

namespace Database\Seeders;


use Database\Factories\AdminFactory;
use Database\Factories\ClientFactory;
use Database\Factories\DirectorFactory;
use Database\Factories\DoctorFactory;
use Database\Factories\EventFactory;
use Database\Factories\MethodistFactory;
use Database\Factories\PaymasterFactory;
use Database\Factories\PaymentFactory;
use Database\Factories\TrainerFactory;
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
            ActivitySeeder::class,
            BenefitSeeder::class,
            CategorySeeder::class,
            EducationSeeder::class,
            RoleSeeder::class,
            PermissionSeeder::class,
            OwnerSeeder::class,
            ServiceSeeder::class,
            SpecializationSeeder::class,
            OptionSeeder::class,
            OrderStatusSeeder::class,
        ]);

        // factories
        AdminFactory::new()->count(1)->create();
        DirectorFactory::new()->count(1)->create();
        MethodistFactory::new()->count(1)->create();
        DoctorFactory::new()->count(2)->create();
        PaymasterFactory::new()->count(2)->create();
        TrainerFactory::new()->count(6)->create();
        ClientFactory::new()->count(30)->create();
        PaymentFactory::new()->count(500)->create();
        EventFactory::new()->count(500)->create();

        // seeders
        $this->call([
            TestSeeder::class,
            TimetableOptionSeeder::class,
        ]);
    }
}
