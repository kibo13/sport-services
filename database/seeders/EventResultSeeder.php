<?php

namespace Database\Seeders;


use App\Enums\Role;
use App\Models\Event;
use App\Models\EventResult;
use App\Models\User;
use Illuminate\Database\Seeder;

class EventResultSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $events = Event::all();

        foreach ($events as $event) {
            $this->createOrUpdateEventResults($event);
        }
    }

    /**
     * Create or update event results for the given event.
     *
     * @param Event $event
     * @return void
     */
    private function createOrUpdateEventResults(Event $event)
    {
        if (! EventResult::query()->where('event_id', $event->id)->exists()) {
            for ($position = 1; $position <= 3; $position++) {
                EventResult::query()->updateOrCreate([
                    'event_id' => $event->id,
                    'position' => $position,
                    'client_id' => $this->getRandomClientId()
                ]);
            }
        }
    }

    /**
     * Generate a random client ID.
     *
     * @return int
     */
    private function getRandomClientId(): int
    {
        $clientId = User::query()
            ->where('role_id', Role::CLIENT)
            ->inRandomOrder()
            ->value('id');

        return (int) $clientId;
    }
}
