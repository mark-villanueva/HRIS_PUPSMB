<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LeaveTypesResource\Pages;
use App\Filament\Resources\LeaveTypesResource\RelationManagers;
use App\Models\LeaveTypes;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Checkbox;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Filters\TernaryFilter;

class LeaveTypesResource extends Resource
{
    protected static ?string $model = LeaveTypes::class;
    protected static ?string $recordTitleAttribute = 'name';
    protected static ?int $navigationSort = 1;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-group';
    protected static ?string $navigationGroup = 'Leave Management';
    


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name') 
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('code') 
                    ->maxLength(255),
                Checkbox::make('requiresleavecredit')
                    ->label('Requires leave credit?'),
                Checkbox::make('Payable')
                    ->label('Payable?')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->sortable(), 
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(), 
                Tables\Columns\TextColumn::make('code')
                    ->sortable(), 
                IconColumn::make('requiresleavecredit')
                    ->label('Requires Leave Credit?')
                    ->boolean(),
                IconColumn::make('payable')
                    ->label('Payable?')
                    ->boolean(),
                
                
            ])
            ->filters([
                TernaryFilter::make('requiresleavecredit'), 
                TernaryFilter::make('payable')
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
            'index' => Pages\ListLeaveTypes::route('/'),
            'create' => Pages\CreateLeaveTypes::route('/create'),
            'edit' => Pages\EditLeaveTypes::route('/{record}/edit'),
        ];
    }
}
