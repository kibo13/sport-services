<?php

namespace Database\Factories;


use App\Enums\Role;
use App\Models\Education;
use App\Models\Group;
use App\Models\PermissionUser;
use App\Models\Specialization;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class TrainerFactory extends Factory
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
            'role_id'           => Role::INSTRUCTOR,
            'education_id'      => $this->getRandomEducationId(),
            'name'              => $this->faker->firstName(),
            'surname'           => $this->faker->lastName(),
            'patronymic'        => $this->faker->firstNameMale(),
            'birthday'          => $this->faker->dateTimeBetween('-35 years', '-25 years')->format('Y-m-d'),
            'phone'             => $this->faker->unique()->numerify('771#######'),
            'email'             => $this->faker->unique()->safeEmail(),
            'address'           => $this->faker->streetAddress() . '-' . $this->faker->buildingNumber(),
            'email_verified_at' => now(),
            'password'          => Hash::make('secret'),
            'experience'        => rand(1, 5),
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
    public function configure(): TrainerFactory
    {
        return $this->afterCreating(function (User $user) {
            $this->syncPermissionsForUser($user);
            $specializationId = $this->getRandomSpecializationId();
            $user->specializations()->attach([$specializationId]);
            $this->createGroupWithActivityAndTrainer($specializationId, $user->id);
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
     * Get a random specialization ID that has less than 2 trainers.
     *
     * @return int
     */
    private function getRandomSpecializationId(): int
    {
        $specializations = Specialization::query()
            ->has('trainers', '<', 2)
            ->inRandomOrder()
            ->pluck('id');

        return $specializations->first();
    }

    /**
     * Get a random education ID.
     *
     * @return int
     */
    private function getRandomEducationId(): int
    {
        $educationId = Education::query()
            ->inRandomOrder()
            ->value('id');

        return (int) $educationId;
    }

    /**
     * Create a group with the specified activity and trainer.
     *
     * @param int $activityId The ID of the activity.
     * @param int $trainerId The ID of the trainer.
     * @return void
     */
    public function createGroupWithActivityAndTrainer(int $activityId, int $trainerId)
    {
        Group::query()->create([
            'name' => 'Группа ' . $activityId . $trainerId,
            'activity_id' => $activityId,
            'trainer_id' => $trainerId,
            'limit' => 12
        ]);
    }
}
