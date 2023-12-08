<?php 

namespace Financas\Report;

class RedirectToReport
{
    public function report(string $name, $farmers): Report
    {
        switch ($name) {
            case 'month':
                return new FarmerByMonthReport($farmers);
            case 'week':
                return new FarmerByWeekReport($farmers);
            case 'year':
                return new FarmerByYearReport($farmers);         
            default:
                return new FarmerByMonthReport($farmers);
        }
    }
}