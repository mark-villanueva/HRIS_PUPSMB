<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HolidayResource\Pages;
use App\Filament\Resources\HolidayResource\RelationManagers;
use App\Models\Holiday;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class HolidayResource extends Resource
{
    protected static ?string $model = Holiday::class;

    protected static ?string $navigationIcon = null;
    protected static ?string $recordTitleAttribute = 'name';
    protected static ?string $navigationLabel = 'Holidays'; 
    protected static ?int $navigationSort = 2;
    protected static ?string $navigationGroup = 'Attendance';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name') 
                    ->required()
                    ->maxLength(255), 
                Select::make('type')
                    ->options([
                        'Regular Holiday' => 'Regular Holiday',
                        'Special Non-Working Holiday' => 'Special Non-Working Holiday',
                    ]),
                DatePicker::make('date')
                    ->required()
                    ->native(false)
                    ->displayFormat('m/d/Y')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->sortable(), 
                Tables\Columns\TextColumn::make('type')
                    ->sortable(), 
                Tables\Columns\TextColumn::make('date')
                    ->sortable()
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListHolidays::route('/'),
            'create' => Pages\CreateHoliday::route('/create'),
            'edit' => Pages\EditHoliday::route('/{record}/edit'),
        ];
    }
}
