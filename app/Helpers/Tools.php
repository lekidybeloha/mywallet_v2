<?php

namespace App\Helpers;

use Carbon\Carbon;
use Carbon\CarbonPeriod;

class Tools
{
    public function getAllDaysCurrentMonth()
    {
        $dates  = [];
        $start  = Carbon::now()->startOfMonth()->format('d-m-Y');
        $end    = Carbon::now()->endOfMonth()->format('d-m-Y');
        $period = CarbonPeriod::create($start, $end);
        foreach ($period as $one)
            $dates[$one->format('Y-m-d')] = $one->format('d-m-Y');

        return $dates;
    }
}
