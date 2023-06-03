<?php


namespace App\Enums\Service;


class ServiceActivity
{
    public const SWIMMING = 1;
    public const GYM      = 2;
    public const TENNIS   = 3;

    public const NAMES = [
        self::SWIMMING => 'Плавание',
        self::GYM      => 'Тренажерный зал',
        self::TENNIS   => 'Теннисный корт',
    ];

    public const COLORS = [
        self::SWIMMING => '#4285F4',
        self::GYM      => '#ffbb33',
        self::TENNIS   => '#00C851',
    ];
}
