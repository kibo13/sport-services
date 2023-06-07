<?php

namespace Database\Factories;


use App\Enums\Service\ServiceCategory;
use App\Enums\Service\ServiceType;
use App\Models\Card;
use App\Models\CardLesson;
use App\Models\Payment;
use App\Models\PermissionUser;
use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
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
            $this->syncPermissionsForUser($user);
            $service = $this->getRandomService();
            $payment = $this->createPayment($user, $service);
            $card = $this->createCard($service, $payment);
            $this->createCardLessons($card);
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
            'amount'      => $service->price,
            'paid_at'     => date('Y-m-d', strtotime('-3 days')),
        ]);
    }

    /**
     * Create a card for the given user, service, and payment.
     *
     * @param Service $service
     * @param Payment $payment
     * @return Builder|Model
     */
    private function createCard(Service $service, Payment $payment)
    {
        return Card::query()->create([
            'client_id'   => $payment->client_id,
            'activity_id' => $service->activity_id,
            'service_id'  => $service->id,
            'payment_id'  => $payment->id,
        ]);
    }

    /**
     * Create card lessons for the given card.
     *
     * @param Card $card
     * @return void
     */
    private function createCardLessons(Card $card): void
    {
        for ($lesson = 1; $lesson <= 12; $lesson++) {
            CardLesson::query()->create([
                'card_id' => $card->id,
                'number'  => $lesson
            ]);
        }
    }
}
