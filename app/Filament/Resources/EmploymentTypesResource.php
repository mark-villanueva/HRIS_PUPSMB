<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EmploymentTypesResource\Pages;
use App\Filament\Resources\EmploymentTypesResource\RelationManagers;
use App\Models\EmploymentTypes;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EmploymentTypesResource extends Resource
{
    protected static ?string $model = EmploymentTypes::class;

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';
    protected static ?string $recordTitleAttribute = 'name';
    protected static ?string $navigationLabel = 'Employments Types'; 
    protected static ?int $navigationSort = 1;
    protected static ?string $navigationGroup = 'Employee';

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
                Tables\Columns\TextColumn::make('id')
                    ->sortable(),
                Tables\Columns\TextColumn::make('code')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('name') 
                    ->searchable()
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
            'index' => Pages\ListEmploymentTypes::route('/'),
            'create' => Pages\CreateEmploymentTypes::route('/create'),
            'edit' => Pages\EditEmploymentTypes::route('/{record}/edit'),
        ];
    }
}
