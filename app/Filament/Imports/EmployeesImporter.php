<?php

namespace App\Filament\Imports;

use App\Models\Employees;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;

class EmployeesImporter extends Importer
{
    protected static ?string $model = Employees::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('employeenumber')
                ->label('Employee Number')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('fullname')
                ->label('Full Name')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('offices')
                ->label('Offices')
                ->requiredMapping()
                ->relationship()
                ->rules(['required']),
            ImportColumn::make('departments')
                ->label('Departments')
                ->requiredMapping()
                ->relationship()
                ->rules(['required']),
            ImportColumn::make('employmenttypes')
                ->label('Employment Types')
                ->requiredMapping()
                ->relationship()
                ->rules(['required']),
            ImportColumn::make('biometric')
                ->label('Biometric')
                ->rules(['max:255']),
            ImportColumn::make('basicsalary') 
                ->label('Basic Salary')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('minimumwage')
                ->label('Minimum Wage')
                ->requiredMapping()
                ->boolean()
                ->rules(['required', 'boolean']),
            ImportColumn::make('payrollgroup')
                ->label('Payroll Group')
                ->requiredMapping()
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
                ->label('PhilHealth Number')
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
                ->rules(['required', 'boolean']),
            ImportColumn::make('holidaypay')
                ->label('Holiday Pay')
                ->requiredMapping()
                ->boolean()
                ->rules(['required', 'boolean']),
            ImportColumn::make('specialholidaypay') 
                ->label('Special Holiday Pay')
                ->requiredMapping()
                ->boolean()
                ->rules(['required', 'boolean']),
            ImportColumn::make('premiumholidaypay')
                ->label('Premium Holiday Pay')
                ->requiredMapping()
                ->boolean()
                ->rules(['required', 'boolean']),
            ImportColumn::make('restdaypay')
                ->label('Restday Pay')
                ->requiredMapping()
                ->boolean()
                ->rules(['required', 'boolean']),
            ImportColumn::make('overtime')
                ->label('Overtime')
                ->requiredMapping()
                ->boolean()
                ->rules(['required', 'boolean']),
            ImportColumn::make('deminimis')
                ->label('De Minimis')
                ->requiredMapping()
                ->boolean()
                ->rules(['required', 'boolean']),
            ImportColumn::make('nightdifferential')
                ->label('Night Differential')
                ->requiredMapping()
                ->boolean()
                ->rules(['required', 'boolean']),
        ];
    }

    public function resolveRecord(): ?Employees
    {
        // return Employees::firstOrNew([
        //     // Update existing records, matching them by `$this->data['column_name']`
        //     'email' => $this->data['email'],
        // ]);

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
}
