<?php


namespace App\Enums\Service;


class ServiceType
{
    public const TICKET = 1;
    public const PASS   = 2;
    public const GROUP  = 3;

    public const NAMES = [
        self::TICKET => null,
        self::PASS   => 'Абонемент свободное посещение',
        self::GROUP  => 'Абонемент в группу',
    ];

    public const UNITS = [
        self::TICKET => 1,
        self::PASS   => 12,
        self::GROUP  => 12,
    ];
}
