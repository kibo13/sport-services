<?php


namespace App\Services\Chart;


class ChartService
{
    public static function generateLabels($from, $till): array
    {
        $temp = $from;
        $labels = [];

        while ($temp < $till) {
            array_push($labels, date('m.Y', strtotime($temp)));
            $temp = date('Y-m-d', strtotime('+1 months', strtotime($temp)));
        }

        return $labels;
    }
}
