<?php


namespace App\Enums;


class Activity
{
    public const SWIMMING = 1;
    public const GYM      = 2;
    public const TENNIS   = 3;

    public const ENDINGS = [
        self::SWIMMING => 'плаванию',
        self::GYM      => 'тренажерному залу',
        self::TENNIS   => 'теннису',
    ];
}
