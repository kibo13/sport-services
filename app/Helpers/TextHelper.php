<?php

function experience_label(int $experience): string
{
    switch ($experience) {
        case 1:
            return 'год';
        case 2:
        case 3:
        case 4:
            return 'года';
        default:
            return 'лет';
    }
}
