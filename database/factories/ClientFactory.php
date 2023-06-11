<?php

namespace Database\Factories;


use App\Enums\Service\ServiceCategory;
use App\Enums\Service\ServiceType;
use App\Models\Benefit;
use App\Models\Card;
use App\Models\Payment;
use App\Models\PermissionUser;
use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;
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

    /**
     * Define the callback to run after creating a user.
     *
     * @return $this
     */
    public function configure(): ClientFactory
    {
        return $this->afterCreating(function (User $user) {
            $this->syncPermissionsForUser($user);
            $service = $this->getRandomService();
            $payment = $this->createPayment($user, $service);
            $this->createCard($service, $payment);
        });
    }

    /**
     * Sync permissions for a user based on their role.
     *
     * @param  User  $user
     * @return void
     */
    private function syncPermissionsForUser(User $user)
    {
        $permissions = config('permissions');

        foreach ($permissions as $permission_id => $permission) {
            if (in_array($user['role_id'], $permission['roles'])) {
                PermissionUser::query()->updateOrCreate([
                    'permission_id' => ++$permission_id,
                    'user_id' => $user['id']
                ]);
            }
        }
    }

    /**
     * Generate a random service.
     *
     * @return Builder|Model|object|null
     */
    private function getRandomService()
    {
        return Service::query()
            ->where('type_id', ServiceType::PASS)
            ->where('category_id', ServiceCategory::ADULT)
            ->inRandomOrder()
            ->first();
    }

    /**
     * @param User $user
     * @param Service $service
     * @return Builder|Model
     */
    private function createPayment(User $user, Service $service)
    {
        return Payment::query()->create([
            'activity_id' => $service->activity_id,
            'service_id'  => $service->id,
            'client_id'   => $user->id,
            'amount'      => $service->price - $service->price * $user->benefit->discount,
            'paid_at'     => date('Y-m-d', strtotime('-3 days')),
        ]);
    }

    /**
     * Create a card for the given user, service, and payment.
     *
     * @param Service $service
     * @param Payment $payment
     * @return void
     */
    private function createCard(Service $service, Payment $payment): void
    {
        Card::query()->create([
            'client_id' => $payment->client_id,
            'activity_id' => $service->activity_id,
            'service_id' => $service->id,
            'payment_id' => $payment->id,
            'start' => $payment->paid_at,
            'end' => date('Y-m-d', strtotime($payment->paid_at . '+2 month')),
        ]);
    }
}
