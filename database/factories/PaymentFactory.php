<?php

namespace Database\Factories;


use App\Enums\Service\ServiceType;
use App\Models\Service;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;

class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        $service = $this->getRandomService();

        return [
            'activity_id' => $service->activity_id,
            'service_id'  => $service->id,
            'amount'      => $service->price,
            'paid_at'     => $this->faker->dateTimeBetween('-1 year', '-7 days')->format('Y-m-d'),
        ];
    }

    /**
     * Generate a random service.
     *
     * @return Builder|Model|object|null
     */
    private function getRandomService()
    {
        return Service::query()
            ->where('type_id', ServiceType::TICKET)
            ->inRandomOrder()
            ->first();
    }
}
