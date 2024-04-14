<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OfficesResource\Pages;
use App\Filament\Resources\OfficesResource\RelationManagers;
use App\Models\Offices;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;


class OfficesResource extends Resource
{
    protected static ?string $model = Offices::class;

    protected static ?string $navigationIcon = null;
    protected static ?string $recordTitleAttribute = 'name';
    protected static ?string $navigationLabel = 'Offices/Locations'; 
    protected static ?int $navigationSort = 2;
    protected static ?string $navigationGroup = 'Company';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('code') 
                    ->maxLength(255), 
                Forms\Components\TextInput::make('name') 
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id'),
                Tables\Columns\TextColumn::make('code')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('name') 
                    ->sortable()
                    ->searchable()
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
            'index' => Pages\ListOffices::route('/'),
            'create' => Pages\CreateOffices::route('/create'),
            'edit' => Pages\EditOffices::route('/{record}/edit'),
        ];
    }
}
