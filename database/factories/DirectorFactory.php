<?php

namespace Database\Factories;


use App\Enums\Role;
use App\Models\PermissionUser;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DirectorFactory extends Factory
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
            'role_id'           => Role::DIRECTOR,
            'name'              => $this->faker->firstName(),
            'surname'           => $this->faker->lastName(),
            'patronymic'        => $this->faker->firstNameMale(),
            'birthday'          => $this->faker->dateTimeBetween('-45 years', '-35 years')->format('Y-m-d'),
            'phone'             => $this->faker->unique()->numerify('777#######'),
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
    public function configure(): DirectorFactory
    {
        return $this->afterCreating(function (User $user) {
            $this->syncPermissionsForUser($user);
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
}
