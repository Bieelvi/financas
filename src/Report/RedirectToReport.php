<?php 

namespace Financas\Report;

class RedirectToReport
{
    public function report(string $name, $farmers): Report
    {
        return match ($name) {
            'month' => new FarmerByMonthReport($farmers),
            'week' => new FarmerByWeekReport($farmers),
            'year' => new FarmerByYearReport($farmers),
            default => new FarmerByMonthReport($farmers),
        };
    }
}