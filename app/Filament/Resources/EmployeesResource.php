<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EmployeesResource\Pages;
use App\Filament\Resources\EmployeesResource\RelationManagers;
use App\Models\Employees;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Checkbox;
use App\Filament\Imports\EmployeesImporter;
use Filament\Tables\Actions\ImportAction;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Section;

class EmployeesResource extends Resource
{
    protected static ?string $model = Employees::class;

    protected static ?string $navigationIcon = null;
    protected static ?string $navigationLabel = 'Employees'; 
    protected static ?int $navigationSort = 3;
    protected static ?string $navigationGroup = 'Employee';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('employeenumber') 
                    ->label('Employee Number')
                    ->required() 
                    ->maxLength(255),
                TextInput::make('fullname') 
                    ->label('Employee Name')
                    ->required()
                    ->placeholder('Last name, First name Middle name')
                    ->maxLength(255), 
                Select::make('offices_id')
                    ->label('Office')
                    ->relationship('offices', 'name')
                    ->searchable()
                    ->preload()
                    ->required() 
                    ->createOptionForm([
                        Forms\Components\TextInput::make('code')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                    ])
                    ->required(), 
                Select::make('departments_id')
                    ->label('Department')
                    ->relationship('departments', 'name')
                    ->searchable()
                    ->preload()
                    ->required(), 
                Select::make('employmenttypes_id')
                    ->label('Employment Status')
                    ->relationship('employmenttypes', 'name')
                    ->searchable()
                    ->preload()
                    ->required(), 
                TextInput::make('biometric') 
                    ->label('Biometric ID')
                    ->placeholder('Biometric ID')
                    ->helperText('The ID used in biometric machine if any')
                    ->maxLength(255),
                Section::make('PAYROLL')
                    ->schema([
                        TextInput::make('basicsalary') 
                            ->label('Basic Salary')
                            ->placeholder('Basic Salary')
                            ->prefix('Php')
                            ->numeric(),
                        Select::make('payrollgroup')
                            ->required()
                            ->label('Payroll Group')
                            ->options([
                                'Weekly' => 'Weekly',
                                'Bi-weekly' => 'Bi-weekly',
                                'Semi-monthly' => 'Semi-monthly', 
                                'Monthly' => 'Monthly'
                            ]), 
                        Checkbox::make('minimumwage')
                            ->label('Minimum Wage')
                        ]) 
                        ->columns(2),
                       
                Section::make('GOVERNMENT')
                    ->schema([
                        TextInput::make('tinnumber') 
                            ->label('TIN Number')
                            ->placeholder('000-000-000-000'),
                        TextInput::make('sssnumber') 
                            ->label('SSS Number')
                            ->placeholder('00-0000000-0'),
                        TextInput::make('philhealthnumber') 
                            ->label('PhilHealth Number')
                            ->placeholder('00-000000000-0'),
                        TextInput::make('hdmf') 
                            ->label('HDMF')
                            ->placeholder('0000-0000-0000'),
                        
                        ])
                        ->columns(2),
                Section::make('BENEFITS')
                    ->schema([
                        Checkbox::make('timesheetrequired')
                            ->label('Timesheet Required'),
                        Checkbox::make('holidaypay')
                            ->label('Holiday Pay'),
                        Checkbox::make('specialholidaypay')
                            ->label('Special Holiday Pay'),
                        Checkbox::make('premiumholidaypay')
                            ->label('Premium Holiday Pay'),
                        Checkbox::make('restdaypay')
                            ->label('Restday Pay'),
                        Checkbox::make('overtime')
                            ->label('Overtime'),
                        Checkbox::make('deminimis')
                            ->label('De Minimis'),
                        Checkbox::make('nightdifferential')
                            ->label('Night Differential'),
                        ])
                            ->columns(4)
                       
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->headerActions([
                ImportAction::make()
                    ->importer(EmployeesImporter::class)
            ])
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->sortable(),

                Tables\Columns\TextColumn::make('employeenumber')
                    ->label('Employee Number')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('fullname')
                ->label('Full Name')
                ->sortable()
                ->searchable(),

                Tables\Columns\TextColumn::make('offices.name') 
                    ->label('Office')
                    ->searchable(),
                Tables\Columns\TextColumn::make('payrollgroup') 
                    ->label('Payroll Group')
                    ->searchable()
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEmployees::route('/'),
            'create' => Pages\CreateEmployees::route('/create'),
            'edit' => Pages\EditEmployees::route('/{record}/edit'),
        ];
    }
}
