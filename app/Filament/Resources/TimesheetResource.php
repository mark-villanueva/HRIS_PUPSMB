<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TimesheetResource\Pages;
use App\Filament\Resources\TimesheetResource\RelationManagers;
use App\Models\Timesheet;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table; 
use App\Filament\Exports\TimesheetExporter;
use Filament\Tables\Actions\ExportAction;
use Filament\Actions\Exports\Enums\ExportFormat;
use App\Filament\Imports\TimesheetImporter;
use Filament\Tables\Actions\ImportAction;
use Filament\Forms\Components\TextInput; 
use Filament\Forms\Components\DatePicker; 
use Filament\Forms\Components\Select;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TimePicker;

class TimesheetResource extends Resource
{
    protected static ?string $model = Timesheet::class;

    protected static ?string $navigationIcon = null;
    protected static ?string $navigationLabel = 'Timesheet'; 
    protected static ?int $navigationSort = 6;
    protected static ?string $navigationGroup = 'Attendance';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('employees_id')
                    ->label('Employee Name')
                    ->relationship('employees', 'fullname')
                    ->searchable()
                    ->preload()
                    ->required(), 
                DatePicker::make('date')
                    ->required(),
                Select::make('schedules_id')
                    ->label('Schedule')
                    ->relationship('schedules', 'name')
                    ->required(),
                TimePicker::make('timein')
                    ->label('Time In')
                    ->seconds(false)
                    ->datalist([
                        '00:00','01:00','02:00','03:00','04:00','05:00','06:00','07:00',
                        '08:00','09:00','10:00','11:00','12:00','13:00','14:00','15:00',
                        '16:00','17:00','18:00','19:00','20:00','21:00','22:00','23:00',
                    ]), 
                TimePicker::make('timeout')
                    ->label('Time Out')
                    ->seconds(false)
                    ->datalist([
                        '00:00','01:00','02:00','03:00','04:00','05:00','06:00','07:00',
                        '08:00','09:00','10:00','11:00','12:00','13:00','14:00','15:00',
                        '16:00','17:00','18:00','19:00','20:00','21:00','22:00','23:00',
                    ]), 
                Forms\Components\TextInput::make('hours')
                    ->label('Hours')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->headerActions([
                ImportAction::make()
                    ->importer(TimesheetImporter::class),
                ExportAction::make()
                    ->exporter(TimesheetExporter::class)
                    ->formats([
                        ExportFormat::Csv,
                ])
            ])
            ->columns([
                Tables\Columns\TextColumn::make('employees.employeenumber')
                    ->label('Employee Number')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('employees.fullname')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('schedules.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('timein'),
                Tables\Columns\TextColumn::make('timeout'),
                Tables\Columns\TextColumn::make('hours')
                    ->numeric()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
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
            'index' => Pages\ListTimesheets::route('/'),
            'create' => Pages\CreateTimesheet::route('/create'),
            'edit' => Pages\EditTimesheet::route('/{record}/edit'),
        ];
    }
}
