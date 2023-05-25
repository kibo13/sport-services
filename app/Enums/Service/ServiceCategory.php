<?php


namespace App\Enums\Service;


class ServiceCategory
{
    public const KID     = 1;
    public const STUDENT = 2;
    public const ADULT   = 3;

    public const NAMES = [
        self::KID     => 'Детский',
        self::STUDENT => 'Студенческий',
        self::ADULT   => 'Взрослый',
    ];
}
