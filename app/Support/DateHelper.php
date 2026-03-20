<?php

namespace App\Support;

use Carbon\Carbon;

class DateHelper
{
    public static function thirdMondayOfUpcomingSeptember(): string
    {
        $now = Carbon::now();
        $september = Carbon::create($now->year, 9, 1)->modify('third monday');

        if ($now->gt($september)) {
            $september = Carbon::create($now->year + 1, 9, 1)->modify('third monday');
        }

        return $september->toDateString();
    }


    /**
     * Calculates the programme end date based on the start date and academic levels.
     * Assumes each level spans one academic year, ending in August.
     *
     * @param Carbon $startDate     The programme's start date.
     * @param int    $startingLevel The starting academic level (e.g., 4).
     * @param int    $finalLevel    The final academic level (default is 6).
     * @return string               The calculated end date (e.g., '2027-08-31').
     */
    public static function calculateProgrammeEndDate(Carbon $startDate, int $startingLevel, int $finalLevel): string
    {
        $years = $finalLevel - $startingLevel + 1;

        return $startDate->copy()
            ->addYears($years)
            ->subMonth()      // back to August
            ->endOfMonth()
            ->toDateString();   // end of August
    }




    /**
     * Get the next academic year in "YYYY/YYYY" format.
     */
    public static function nextAcademicYear(): string
    {
        $now = Carbon::now();
        $startYear = $now->month >= 9 ? $now->year + 1 : $now->year;
        $endYear = $startYear + 1;

        return "{$startYear}/{$endYear}";
    }
}
