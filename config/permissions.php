<?php

use App\Enums\Role;

return [
    [
        'name'       => 'Льготники',
        'slug'       => 'benefit_read',
        'is_setting' => 1,
        'note'       => 'Просмотр',
        'roles'      => [
            Role::ADMIN,
            Role::DIRECTOR,
            Role::PAYMASTER,
        ],
    ],
    [
        'name'       => 'Льготники',
        'slug'       => 'benefit_full',
        'is_setting' => 1,
        'note'       => 'Редактирование',
        'roles'      => [
            Role::ADMIN,
            Role::DIRECTOR,
        ],
    ],
    [
        'name'       => 'Методики',
        'slug'       => 'method_read',
        'is_setting' => 1,
        'note'       => 'Просмотр',
        'roles'      => [
            Role::ADMIN,
            Role::DIRECTOR,
        ],
    ],
    [
        'name'       => 'Методики',
        'slug'       => 'method_full',
        'is_setting' => 1,
        'note'       => 'Редактирование',
        'roles'      => [
            Role::ADMIN,
            Role::DIRECTOR,
        ],
    ],
    [
        'name'       => 'Платежи',
        'slug'       => 'pay_read',
        'is_setting' => 0,
        'note'       => 'Просмотр',
        'roles'      => [
            Role::ADMIN,
            Role::DIRECTOR,
            Role::PAYMASTER,
        ],
    ],
    [
        'name'       => 'Платежи',
        'slug'       => 'pay_full',
        'is_setting' => 0,
        'note'       => 'Редактирование',
        'roles'      => [
            Role::ADMIN,
            Role::DIRECTOR,
            Role::PAYMASTER,
        ],
    ],
    [
        'name'       => 'Специализации',
        'slug'       => 'specialization_read',
        'is_setting' => 1,
        'note'       => 'Просмотр',
        'roles'      => [
            Role::ADMIN,
            Role::DIRECTOR,
        ],
    ],
    [
        'name'       => 'Специализации',
        'slug'       => 'specialization_full',
        'is_setting' => 1,
        'note'       => 'Редактирование',
        'roles'      => [
            Role::ADMIN,
            Role::DIRECTOR,
        ],
    ],
    [
        'name'       => 'Услуги',
        'slug'       => 'service_read',
        'is_setting' => 0,
        'note'       => 'Просмотр',
        'roles'      => [
            Role::ADMIN,
            Role::DIRECTOR,
            Role::PAYMASTER,
            Role::INSTRUCTOR,
            Role::DOCTOR,
            Role::CLIENT,
        ],
    ],
    [
        'name'       => 'Услуги',
        'slug'       => 'service_full',
        'is_setting' => 0,
        'note'       => 'Редактирование',
        'roles'      => [
            Role::ADMIN,
            Role::DIRECTOR,
            Role::PAYMASTER,
        ],
    ],
    [
        'name'       => 'Карточки',
        'slug'       => 'card_read',
        'is_setting' => 0,
        'note'       => 'Просмотр',
        'roles'      => [
            Role::ADMIN,
            Role::DIRECTOR,
            Role::PAYMASTER
        ],
    ],
    [
        'name'       => 'Карточки',
        'slug'       => 'card_full',
        'is_setting' => 0,
        'note'       => 'Редактирование',
        'roles'      => [
            Role::ADMIN,
            Role::DIRECTOR,
            Role::PAYMASTER
        ],
    ],
    [
        'name'       => 'Занятия',
        'slug'       => 'lesson_read',
        'is_setting' => 0,
        'note'       => 'Просмотр',
        'roles'      => [
            Role::CLIENT,
        ],
    ],
    [
        'name'       => 'Занятия',
        'slug'       => 'lesson_full',
        'is_setting' => 0,
        'note'       => 'Редактирование',
        'roles'      => [
            Role::ADMIN,
            Role::DIRECTOR,
        ],
    ],
    [
        'name'       => 'Клиенты',
        'slug'       => 'client_read',
        'is_setting' => 0,
        'note'       => 'Просмотр',
        'roles'      => [
            Role::ADMIN,
            Role::DIRECTOR,
            Role::DOCTOR
        ],
    ],
    [
        'name'       => 'Клиенты',
        'slug'       => 'client_full',
        'is_setting' => 0,
        'note'       => 'Редактирование',
        'roles'      => [
            Role::ADMIN,
            Role::DIRECTOR,
        ],
    ],
    [
        'name'       => 'Тренеры',
        'slug'       => 'trainer_read',
        'is_setting' => 0,
        'note'       => 'Просмотр',
        'roles'      => [
            Role::ADMIN,
            Role::DIRECTOR,
            Role::DOCTOR,
        ],
    ],
    [
        'name'       => 'Тренеры',
        'slug'       => 'trainer_full',
        'is_setting' => 0,
        'note'       => 'Редактирование',
        'roles'      => [
            Role::ADMIN,
            Role::DIRECTOR,
        ],
    ],
    [
        'name'       => 'Расписание',
        'slug'       => 'timetable_read',
        'is_setting' => 0,
        'note'       => 'Просмотр',
        'roles'      => [
            Role::ADMIN,
            Role::DIRECTOR,
            Role::INSTRUCTOR,
            Role::CLIENT
        ],
    ],
    [
        'name'       => 'Расписание',
        'slug'       => 'timetable_full',
        'is_setting' => 0,
        'note'       => 'Редактирование',
        'roles'      => [
            Role::ADMIN,
            Role::DIRECTOR,
            Role::INSTRUCTOR
        ],
    ],
    [
        'name'       => 'Мероприятия',
        'slug'       => 'event_read',
        'is_setting' => 0,
        'note'       => 'Просмотр',
        'roles'      => [
            Role::ADMIN,
            Role::DIRECTOR,
            Role::INSTRUCTOR,
        ],
    ],
    [
        'name'       => 'Мероприятия',
        'slug'       => 'event_full',
        'is_setting' => 0,
        'note'       => 'Редактирование',
        'roles'      => [
            Role::ADMIN,
            Role::DIRECTOR,
            Role::INSTRUCTOR,
        ],
    ],
    [
        'name'       => 'Отчеты',
        'slug'       => 'report_read',
        'is_setting' => 0,
        'note'       => 'Просмотр',
        'roles'      => [
            Role::ADMIN,
            Role::DIRECTOR,
        ],
    ],
    [
        'name'       => 'Статистика',
        'slug'       => 'stat_read',
        'is_setting' => 0,
        'note'       => 'Просмотр',
        'roles'      => [
            Role::ADMIN,
            Role::DIRECTOR,
        ],
    ],
];
