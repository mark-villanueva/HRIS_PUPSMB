<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PayrollResource\Pages;
use App\Filament\Resources\PayrollResource\RelationManagers;
use App\Models\Payroll;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\ToggleColumn;

class PayrollResource extends Resource
{
    protected static ?string $model = Payroll::class;

    protected static ?string $navigationIcon = 'heroicon-o-banknotes';
    protected static ?string $navigationLabel = 'Payroll'; 
    protected static ?int $navigationSort = 1;
    protected static ?string $navigationGroup = 'Payroll Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('employees_id')
                    ->label('Payroll Group')
                    ->relationship('employees', 'payrollgroup')
                    ->searchable()
                    ->preload()
                    ->required(), 
                Forms\Components\DatePicker::make('date')
                    ->required(),
                Forms\Components\TextInput::make('gross')
                    ->numeric(),
                Forms\Components\TextInput::make('net')
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('employees.payrollgroup')
                    ->label('Payroll Group / Period'),
                Tables\Columns\TextColumn::make('date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('gross')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('net')
                    ->numeric()
                    ->sortable(),
                ToggleColumn::make('is_open')
                    ->default(false)

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
            'index' => Pages\ListPayrolls::route('/'),
            'create' => Pages\CreatePayroll::route('/create'),
            'edit' => Pages\EditPayroll::route('/{record}/edit'),
        ];
    }
}
