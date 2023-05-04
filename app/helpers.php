<?php

use Carbon\Carbon;

if (! function_exists('daysBetweenDates'))
{
    function daysBetweenDates($startDate, $endDate): int
    {
        $datetime1 = Carbon::parse($startDate);
        $datetime2 = Carbon::parse($endDate);

        $interval = $datetime1->diff($datetime2);

        return (int) $interval->format('%a');
    }
}
