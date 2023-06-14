<?php

namespace Database\Seeders;


use App\Models\OrderStatus;
use Illuminate\Database\Seeder;

class OrderStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statuses = [
            [
                'name' => 'Новая',
                'color' => '#4285F4',
            ],
            [
                'name' => 'Завершена',
                'color' => '#00C851',
            ],
            [
                'name' => 'Отменена',
                'color' => '#ffbb33',
            ],
            [
                'name' => 'Отклонена',
                'color' => '#ff4444',
            ],
        ];

        foreach ($statuses as $status) {
            OrderStatus::query()->updateOrCreate(['name' => $status['name']], $status);
        }
    }
}
