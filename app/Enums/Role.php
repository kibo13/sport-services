<?php


namespace App\Enums;


class Role
{
    public const OWNER      = 1;
    public const ADMIN      = 2;
    public const DIRECTOR   = 3;
    public const PAYMASTER  = 4;
    public const INSTRUCTOR = 5;
    public const DOCTOR     = 6;
    public const CLIENT     = 7;
    public const METHODIST  = 8;

    public const NAMES = [
        self::OWNER      => 'Владелец',
        self::ADMIN      => 'Администратор',
        self::DIRECTOR   => 'Директор',
        self::PAYMASTER  => 'Кассир',
        self::INSTRUCTOR => 'Инструктор',
        self::DOCTOR     => 'Врач',
        self::CLIENT     => 'Клиент',
        self::METHODIST  => 'Инструктор-методист',
    ];

    public const SLUGS = [
        self::OWNER      => 'owner',
        self::ADMIN      => 'admin',
        self::DIRECTOR   => 'director',
        self::PAYMASTER  => 'paymaster',
        self::INSTRUCTOR => 'instructor',
        self::DOCTOR     => 'doctor',
        self::CLIENT     => 'client',
        self::METHODIST  => 'methodist',
    ];
}
