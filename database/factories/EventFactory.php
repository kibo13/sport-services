<?php

namespace Database\Factories;


use App\Models\Specialization;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
{
    /**
     * Array of available places.
     *
     * @var array
     */
    private $places = ['Маяк', 'Орион', 'Стадион'];

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        $specializationId = $this->getRandomSpecializationId();

        return [
            'title'             => 'Соревнование ' . $this->faker->unique()->numerify('#####'),
            'specialization_id' => $specializationId,
            'trainer_id'        => $this->getRandomTrainerId($specializationId),
            'start'             => $this->faker->dateTimeBetween('+7 days', '+3 months')->format('Y-m-d'),
            'place'             => $this->places[array_rand($this->places)],
        ];
    }

    /**
     * Generate a random specialization ID.
     *
     * @return int
     */
    private function getRandomSpecializationId(): int
    {
        $specializationId = Specialization::query()
            ->inRandomOrder()
            ->value('id');

        return (int) $specializationId;
    }

    /**
     * Generate a random trainer ID from the given specialization.
     *
     * @param int $specializationId
     * @return int
     */
    private function getRandomTrainerId(int $specializationId): int
    {
        $trainerId = Specialization::query()
            ->find($specializationId)
            ->trainers()
            ->inRandomOrder()
            ->value('id');

        return (int) $trainerId;
    }
}
