<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CompanyResource\Pages;
use App\Filament\Resources\CompanyResource\RelationManagers;
use App\Models\Company;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\TextInput; 
use Filament\Forms\Components\Select;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CompanyResource extends Resource
{
    protected static ?string $model = Company::class;
    protected static ?string $recordTitleAttribute = 'name';
    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';
    protected static ?string $navigationLabel = 'Company Settings';
    protected static ?int $navigationSort = 1;
    protected static ?string $navigationGroup = 'Company';
    
    

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name') 
                    ->required()
                    ->maxLength(255),
                TextInput::make('tradename') 
                    ->label('Trade Name')
                    ->required()
                    ->maxLength(255),
                Select::make('type')
                    ->options([
                        'Private' => 'Private',
                        'Public' => 'Public',    
                    ])
                    ->required(),
                TextInput::make('tin')
                    ->label('TIN')
                    ->numeric()
                    ->required(),
                TextInput::make('rdo')
                    ->label('RDO')
                    ->numeric()
                    ->required(), 
                TextInput::make('sss')
                    ->label('SSS')
                    ->numeric()
                    ->required(),
                TextInput::make('hdmf')
                    ->label('HDMF')
                    ->numeric()
                    ->required(),
                TextInput::make('philhealth')
                    ->label('PHILHEALTH')
                    ->numeric()
                    ->required(),
                 ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Name'),
                Tables\Columns\TextColumn::make('tradename') 
                    ->label('Trade Name'),
                Tables\Columns\TextColumn::make('type')
                    ->label('Type'),
                Tables\Columns\TextColumn::make('tin')
                    ->label('TIN'),
                Tables\Columns\TextColumn::make('rdo') 
                    ->label('RDO'),
                Tables\Columns\TextColumn::make('sss') 
                    ->label('SSS'),
                Tables\Columns\TextColumn::make('hdmf') 
                    ->label('HDMF'),
                Tables\Columns\TextColumn::make('philhealth') 
                    ->label('PHILHEALTH'),
                
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
            'index' => Pages\ListCompanies::route('/'),
            'create' => Pages\CreateCompany::route('/create'),
            'edit' => Pages\EditCompany::route('/{record}/edit'),
        ];
    }
}
