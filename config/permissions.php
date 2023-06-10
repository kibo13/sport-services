<?php

use App\Enums\Role;

return [
    [
        'name'       => 'Льготники',
        'slug'       => 'benefit_read',
        'is_setting' => 1,
        'note'       => 'Просмотр',
        'roles'      => [
            Role::OWNER,
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
            Role::OWNER,
        ],
    ],
    [
        'name'       => 'Платежи',
        'slug'       => 'pay_read',
        'is_setting' => 0,
        'note'       => 'Просмотр',
        'roles'      => [
            Role::OWNER,
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
            Role::OWNER,
            Role::PAYMASTER,
        ],
    ],
    [
        'name'       => 'Специализации',
        'slug'       => 'specialization_read',
        'is_setting' => 1,
        'note'       => 'Просмотр',
        'roles'      => [
            Role::OWNER,
            Role::DIRECTOR,
        ],
    ],
    [
        'name'       => 'Специализации',
        'slug'       => 'specialization_full',
        'is_setting' => 1,
        'note'       => 'Редактирование',
        'roles'      => [
            Role::OWNER,
        ],
    ],
    [
        'name'       => 'Образования',
        'slug'       => 'education_read',
        'is_setting' => 1,
        'note'       => 'Просмотр',
        'roles'      => [
            Role::OWNER,
            Role::DIRECTOR,
        ],
    ],
    [
        'name'       => 'Образования',
        'slug'       => 'education_full',
        'is_setting' => 1,
        'note'       => 'Редактирование',
        'roles'      => [
            Role::OWNER,
        ],
    ],
    [
        'name'       => 'Услуги',
        'slug'       => 'service_read',
        'is_setting' => 0,
        'note'       => 'Просмотр',
        'roles'      => [
            Role::OWNER,
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
            Role::OWNER,
            Role::PAYMASTER,
        ],
    ],
    [
        'name'       => 'Карточки',
        'slug'       => 'card_read',
        'is_setting' => 0,
        'note'       => 'Просмотр',
        'roles'      => [
            Role::OWNER,
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
            Role::OWNER,
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
            Role::OWNER,
            Role::ADMIN,
        ],
    ],
    [
        'name'       => 'Клиенты',
        'slug'       => 'client_read',
        'is_setting' => 0,
        'note'       => 'Просмотр',
        'roles'      => [
            Role::OWNER,
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
            Role::OWNER,
            Role::ADMIN,
        ],
    ],
    [
        'name'       => 'Тренеры',
        'slug'       => 'trainer_read',
        'is_setting' => 0,
        'note'       => 'Просмотр',
        'roles'      => [
            Role::OWNER,
            Role::ADMIN,
            Role::DIRECTOR,
            Role::DOCTOR
        ],
    ],
    [
        'name'       => 'Тренеры',
        'slug'       => 'trainer_full',
        'is_setting' => 0,
        'note'       => 'Редактирование',
        'roles'      => [
            Role::OWNER,
            Role::ADMIN,
        ],
    ],
    [
        'name'       => 'Мероприятия',
        'slug'       => 'event_read',
        'is_setting' => 0,
        'note'       => 'Просмотр',
        'roles'      => [
            Role::OWNER,
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
            Role::OWNER,
            Role::INSTRUCTOR,
        ],
    ],
    [
        'name'       => 'Отчеты',
        'slug'       => 'report_read',
        'is_setting' => 0,
        'note'       => 'Просмотр',
        'roles'      => [
            Role::OWNER,
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
            Role::OWNER,
            Role::DIRECTOR,
        ],
    ],
];
