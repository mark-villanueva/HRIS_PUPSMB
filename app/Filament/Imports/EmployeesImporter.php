<?php

namespace App\Filament\Imports;

use App\Models\Employees;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;
use Filament\Forms\Components\Checkbox;

class EmployeesImporter extends Importer
{
    protected static ?string $model = Employees::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('employeenumber')
                ->label('Employee Number')
                ->rules(['required', 'max:255']),
            ImportColumn::make('fullname')
                ->label('Full Name')
                ->rules(['max:255']),
            ImportColumn::make('offices')
                ->label('Offices')
                ->relationship()
                ->rules(['required']),
            ImportColumn::make('departments')
                ->label('Departments')
                ->relationship()
                ->rules(['required']),
            ImportColumn::make('employmenttypes')
                ->label('Employment Types')
                ->relationship()
                ->rules(['required']),
            ImportColumn::make('biometric')
                ->label('Biometric ID')
                ->rules(['max:255']),
            ImportColumn::make('basicsalary')
                ->label('Basic Salary')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('minimumwage')
                ->label('Minimum Wage')
                ->boolean()
                ->rules(['boolean']),
            ImportColumn::make('payrollgroup')
                ->label('Payroll Group')
                ->rules(['required', 'max:255']),
            ImportColumn::make('tinnumber')
                ->label('TIN Number')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('sssnumber')
                ->label('SSS Number')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('philhealthnumber')
                ->label('Philhealth Number')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('hdmf')
                ->label('HDMF')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('timesheetrequired')
                ->label('Timesheet Required')
                ->requiredMapping()
                ->boolean()
                ->rules(['boolean']),
            ImportColumn::make('holidaypay')
                ->label('Holiday Pay')
                ->requiredMapping()
                ->boolean()
                ->rules(['boolean']),
            ImportColumn::make('specialholidaypay')
                ->label('Special Holiday Pay')
                ->requiredMapping()
                ->boolean()
                ->rules(['boolean']),
            ImportColumn::make('premiumholidaypay')
                ->label('Premium Holiday Pay')
                ->requiredMapping()
                ->boolean()
                ->rules(['boolean']),
            ImportColumn::make('restdaypay')
                ->label('Rest Day Pay')
                ->requiredMapping()
                ->boolean()
                ->rules(['boolean']),
            ImportColumn::make('overtime')
                ->label('Overtime')
                ->requiredMapping()
                ->boolean()
                ->rules(['boolean']),
            ImportColumn::make('deminimis')
                ->label('De Minimis')
                ->requiredMapping()
                ->boolean()
                ->rules(['boolean']),
            ImportColumn::make('nightdifferential')
                ->label('Night Differential')
                ->requiredMapping()
                ->boolean()
                ->rules(['boolean']),
        ];
    }

    public function resolveRecord(): ?Employees
    {
        if ($this->options['updateExisting'] ?? false) {
        return Employees::firstOrNew([
            'employeenumber' => $this->data['employeenumber'],
        ]);
    }
        return new Employees();
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your employees import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }

    public static function getOptionsFormComponents(): array
{
    return [
        Checkbox::make('updateExisting')
            ->label('Update existing records'),
    ];
}
}
