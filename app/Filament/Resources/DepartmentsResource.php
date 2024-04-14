<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DepartmentsResource\Pages;
use App\Filament\Resources\DepartmentsResource\RelationManagers;
use App\Models\Departments;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DepartmentsResource extends Resource
{
    protected static ?string $model = Departments::class;

    protected static ?string $navigationIcon = null;
    protected static ?string $recordTitleAttribute = 'name';
    protected static ?string $navigationLabel = 'Departments';
    protected static ?int $navigationSort = 3;
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
                Forms\Components\TextInput::make('address') 
                    ->maxLength(255)
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
                    ->searchable(),
                Tables\Columns\TextColumn::make('address')  
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
            'index' => Pages\ListDepartments::route('/'),
            'create' => Pages\CreateDepartments::route('/create'),
            'edit' => Pages\EditDepartments::route('/{record}/edit'),
        ];
    }
}
