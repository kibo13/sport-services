<?php

function count_days_in_month($month, $year): int
{
    return cal_days_in_month(CAL_GREGORIAN, $month, $year);
}
