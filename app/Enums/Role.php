<?php


namespace App\Enums;


class Role
{
    public const ADMIN      = 1;
    public const DIRECTOR   = 2;
    public const PAYMASTER  = 3;
    public const INSTRUCTOR = 4;
    public const DOCTOR     = 5;
    public const CLIENT     = 6;

    public const NAMES = [
        self::ADMIN      => 'Администратор',
        self::DIRECTOR   => 'Директор',
        self::PAYMASTER  => 'Кассир',
        self::INSTRUCTOR => 'Инструктор',
        self::DOCTOR     => 'Врач',
        self::CLIENT     => 'Клиент',
    ];

    public const SLUGS = [
        self::ADMIN      => 'admin',
        self::DIRECTOR   => 'director',
        self::PAYMASTER  => 'paymaster',
        self::INSTRUCTOR => 'instructor',
        self::DOCTOR     => 'doctor',
        self::CLIENT     => 'client',
    ];
}
