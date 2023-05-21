<?php

function format_phone_number_for_storage(?string $phoneNumber): ?string
{
    if (is_null($phoneNumber)) {
        return null;
    }

    return preg_replace('/[^0-9]/', '', str_replace('+7', '', $phoneNumber));
}

function format_phone_number_for_display(?string $phoneNumber): ?string
{
    if (is_null($phoneNumber)) {
        return null;
    }

    // Удаление всех символов, кроме цифр
    $phoneNumber = preg_replace('/\D/', '', $phoneNumber);

    // Проверка наличия кода страны
    if (strlen($phoneNumber) == 10) {
        $countryCode = '+7';
        $areaCode    = substr($phoneNumber, 0, 3);
        $firstPart   = substr($phoneNumber, 3, 3);
        $secondPart  = substr($phoneNumber, 6, 2);
        $lastPart    = substr($phoneNumber, 8);

        return "{$countryCode} {$areaCode} {$firstPart} {$secondPart} {$lastPart}";
    }

    return $phoneNumber;
}
