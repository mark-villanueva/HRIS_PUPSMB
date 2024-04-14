<?php

namespace App\Filament\Widgets;

use App\Models\Offices;
use App\Models\Departments; 
use App\Models\Employees;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class CompanyOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Offices', Offices::count()), 
            Stat::make('Total Departments', Departments::count()),
            Stat::make('Total Employees', Employees::count()),
        ];
    }
}
