<?php

namespace Database\Factories;


use App\Enums\Service\ServiceType;
use App\Models\Benefit;
use App\Models\Card;
use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'benefit_id'        => $this->getRandomBenefitId(),
            'name'              => $this->faker->firstName(),
            'surname'           => $this->faker->lastName(),
            'patronymic'        => $this->faker->firstNameMale(),
            'birthday'          => $this->faker->dateTimeBetween('-25 years', '-16 years')->format('Y-m-d'),
            'phone'             => $this->faker->unique()->numerify('771#######'),
            'email'             => $this->faker->unique()->safeEmail(),
            'address'           => $this->faker->streetAddress() . '-' . $this->faker->buildingNumber(),
            'email_verified_at' => now(),
            'password'          => Hash::make('secret'),
            'remember_token'    => Str::random(10),
            'certificate'       => $this->generateFile(),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return Factory
     */
    public function unverified(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }

    /**
     * Define the callback to run after creating a user.
     *
     * @return $this
     */
    public function configure(): ClientFactory
    {
        return $this->afterCreating(function (User $user) {
            Card::query()->create([
                'client_id'  => $user->id,
                'service_id' => $this->getRandomServiceId(),
            ]);
        });
    }

    /**
     * Generate a random service ID.
     *
     * @return int
     */
    private function getRandomServiceId(): int
    {
        $service = Service::query()
            ->where('type_id', ServiceType::PASS)
            ->inRandomOrder()
            ->first();

        return $service->id;
    }

    /**
     * Generate a random benefit ID.
     *
     * @return int
     */
    private function getRandomBenefitId(): int
    {
        $service = Benefit::query()
            ->inRandomOrder()
            ->first();

        return $service->id;
    }

    /**
     * Generate a random file and save it in the specified directory.
     *
     * @return string The generated file name.
     */
    protected function generateFile(): string
    {
        $templateFile = public_path('assets/images/certificate.jpg');
        $destinationDirectory = 'certificates';
        $fileName = $this->faker->uuid . '.jpg';
        $file = new File($templateFile);

        Storage::disk('public')->putFileAs($destinationDirectory, $file, $fileName);

        return $destinationDirectory . '/' . $fileName;
    }
}
