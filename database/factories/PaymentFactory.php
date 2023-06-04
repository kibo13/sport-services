<?php

namespace Database\Factories;


use App\Enums\Service\ServiceType;
use App\Models\Activity;
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
        $activityId = $this->getRandomActivityId();
        $service = $this->getRandomService($activityId);

        return [
            'activity_id' => $activityId,
            'service_id'  => $service->id,
            'amount'      => $service->price,
            'paid_at'     => $this->faker->dateTimeBetween('-1 year', '-7 days')->format('Y-m-d'),
        ];
    }

    /**
     * Generate a random activity ID.
     *
     * @return int
     */
    private function getRandomActivityId(): int
    {
        $activity = Activity::query()
            ->inRandomOrder()
            ->first();

        return $activity->id;
    }

    /**
     * Generate a random service.
     *
     * @param int $activityId
     * @return Builder|Model|object|null
     */
    private function getRandomService(int $activityId)
    {
        return Service::query()
            ->where('type_id', ServiceType::TICKET)
            ->where('activity_id', $activityId)
            ->inRandomOrder()
            ->first();
    }
}
