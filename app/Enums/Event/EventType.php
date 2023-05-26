<?php


namespace App\Enums\Event;


class EventType
{
    public const SWIMMING      = 1;
    public const TENNIS        = 2;
    public const POWERLIFTING  = 3;
    public const ARM_WRESTLING = 4;

    public const NAMES = [
        self::SWIMMING      => 'Плавание',
        self::TENNIS        => 'Теннис',
        self::POWERLIFTING  => 'Пауэрлифтинг',
        self::ARM_WRESTLING => 'Армреслинг',
    ];
}
