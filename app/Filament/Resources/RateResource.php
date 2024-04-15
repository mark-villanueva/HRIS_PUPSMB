<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RateResource\Pages;
use App\Filament\Resources\RateResource\RelationManagers;
use App\Models\Rate;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RateResource extends Resource
{
    protected static ?string $model = Rate::class;

    protected static ?string $navigationIcon = 'heroicon-o-banknotes'; 
    protected static ?string $recordTitleAttribute = 'type';
    protected static ?string $navigationLabel = 'Rates'; 
    protected static ?int $navigationSort = 3;
    protected static ?string $navigationGroup = 'Attendance';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('type') 
                    ->required(),
                TextInput::make('regular') 
                    ->required()
                    ->numeric(),
                TextInput::make('overtime') 
                    ->required()
                    ->numeric(),
                TextInput::make('nightdifferential') 
                    ->label('Night Differential')
                    ->required()
                    ->numeric(),
                TextInput::make('nightdifferentialovertime') 
                    ->label('Night Differential-Overtime')
                    ->required()
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('type'),
                Tables\Columns\TextColumn::make('regular'),
                Tables\Columns\TextColumn::make('overtime'),
                Tables\Columns\TextColumn::make('nightdifferential')
                    ->label('Night Differential'), 
                Tables\Columns\TextColumn::make('nightdifferentialovertime')
                    ->label('Night Differential-Overtime'), 

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
            'index' => Pages\ListRates::route('/'),
            'create' => Pages\CreateRate::route('/create'),
            'edit' => Pages\EditRate::route('/{record}/edit'),
        ];
    }
}
