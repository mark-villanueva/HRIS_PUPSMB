<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TardinessResource\Pages;
use App\Filament\Resources\TardinessResource\RelationManagers;
use App\Models\Tardiness;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Forms\Components\TextInput;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TardinessResource extends Resource
{
    protected static ?string $model = Tardiness::class;

    protected static ?string $navigationIcon = null;
    protected static ?string $recordTitleAttribute = 'name';
    protected static ?string $navigationLabel = 'Tardiness'; 
    protected static ?int $navigationSort = 4;
    protected static ?string $navigationGroup = 'Attendance';
    

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name') 
                    ->required(),
                TextInput::make('graceperiod') 
                    ->label('Grace Period')
                    ->required()
                    ->numeric(),
                TextInput::make('startdeducting') 
                    ->label('Start Deducting')
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->sortable() 
                    ->searchable(),
                Tables\Columns\TextColumn::make('graceperiod')
                    ->sortable() 
                    ->label('Grace Period'), 
                Tables\Columns\TextColumn::make('startdeducting')
                    ->sortable() 
                    ->label('Start Deducting'), 
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
            'index' => Pages\ListTardiness::route('/'),
            'create' => Pages\CreateTardiness::route('/create'),
            'edit' => Pages\EditTardiness::route('/{record}/edit'),
        ];
    }
}
