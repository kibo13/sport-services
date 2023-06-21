<?php

function generate_color(): string
{
    $randomValue = mt_rand(0, 0xFFFFFF);
    $randomColor = sprintf("#%06x", $randomValue);

    return $randomColor;
}
