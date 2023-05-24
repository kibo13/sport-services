<?php

namespace Database\Seeders;


use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            [
                'name'       => 'Льготники',
                'slug'       => 'benefit_read',
                'is_setting' => 1,
                'note'       => 'Просмотр',
            ],
            [
                'name'       => 'Льготники',
                'slug'       => 'benefit_full',
                'is_setting' => 1,
                'note'       => 'Редактирование',
            ],
            [
                'name'       => 'Методики',
                'slug'       => 'method_read',
                'is_setting' => 1,
                'note'       => 'Просмотр',
            ],
            [
                'name'       => 'Методики',
                'slug'       => 'method_full',
                'is_setting' => 1,
                'note'       => 'Редактирование',
            ],
            [
                'name'       => 'Помещения',
                'slug'       => 'room_read',
                'is_setting' => 1,
                'note'       => 'Просмотр',
            ],
            [
                'name'       => 'Помещения',
                'slug'       => 'room_full',
                'is_setting' => 1,
                'note'       => 'Редактирование',
            ],
            [
                'name'       => 'Специализации',
                'slug'       => 'specialization_read',
                'is_setting' => 1,
                'note'       => 'Просмотр',
            ],
            [
                'name'       => 'Специализации',
                'slug'       => 'specialization_full',
                'is_setting' => 1,
                'note'       => 'Редактирование',
            ],
            [
                'name'       => 'Услуги',
                'slug'       => 'service_read',
                'is_setting' => 1,
                'note'       => 'Просмотр',
            ],
            [
                'name'       => 'Услуги',
                'slug'       => 'service_full',
                'is_setting' => 1,
                'note'       => 'Редактирование',
            ],
            [
                'name'       => 'Абонементы',
                'slug'       => 'pass_read',
                'is_setting' => 0,
                'note'       => 'Просмотр',
            ],
            [
                'name'       => 'Абонементы',
                'slug'       => 'pass_full',
                'is_setting' => 0,
                'note'       => 'Редактирование',
            ],
            [
                'name'       => 'Клиенты',
                'slug'       => 'client_read',
                'is_setting' => 0,
                'note'       => 'Просмотр',
            ],
            [
                'name'       => 'Клиенты',
                'slug'       => 'client_full',
                'is_setting' => 0,
                'note'       => 'Редактирование',
            ],
            [
                'name'       => 'Тренеры',
                'slug'       => 'trainer_read',
                'is_setting' => 0,
                'note'       => 'Просмотр',
            ],
            [
                'name'       => 'Тренеры',
                'slug'       => 'trainer_full',
                'is_setting' => 0,
                'note'       => 'Редактирование',
            ],
            [
                'name'       => 'Расписание',
                'slug'       => 'timetable_read',
                'is_setting' => 0,
                'note'       => 'Просмотр',
            ],
            [
                'name'       => 'Расписание',
                'slug'       => 'timetable_full',
                'is_setting' => 0,
                'note'       => 'Редактирование',
            ],
            [
                'name'       => 'Мероприятия',
                'slug'       => 'event_read',
                'is_setting' => 0,
                'note'       => 'Просмотр',
            ],
            [
                'name'       => 'Мероприятия',
                'slug'       => 'event_full',
                'is_setting' => 0,
                'note'       => 'Редактирование',
            ],
            [
                'name'       => 'Отчеты',
                'slug'       => 'report_read',
                'is_setting' => 0,
                'note'       => 'Просмотр',
            ],
            [
                'name'       => 'Статистика',
                'slug'       => 'stat_read',
                'is_setting' => 0,
                'note'       => 'Просмотр',
            ],
        ];

        foreach ($permissions as $permission) {
            Permission::query()->updateOrCreate($permission);
        }
    }
}
