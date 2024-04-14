<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LeaveRequestsResource\Pages;
use App\Filament\Resources\LeaveRequestsResource\RelationManagers;
use App\Models\LeaveRequests;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LeaveRequestsResource extends Resource
{
    protected static ?string $model = LeaveRequests::class;

    protected static ?int $navigationSort = 2;
    protected static ?string $navigationIcon = null;
    protected static ?string $navigationGroup = 'Leave Management';

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
                Select::make('leavetypes_id')
                    ->label('Select Leave Type')
                    ->relationship('leavetypes', 'name')
                    ->searchable()
                    ->preload()
                    ->required(), 
                DatePicker::make('from')
                    ->label('From')
                    ->required()
                    ->native(false)
                    ->displayFormat('m/d/Y'), 
                DatePicker::make('to')
                    ->label('To')
                    ->required()
                    ->native(false)
                    ->displayFormat('m/d/Y'),
                TextArea::make('description')
                    ->required()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('employees.fullname')
                    ->label('Name')
                    ->sortable() 
                    ->searchable(),
                Tables\Columns\TextColumn::make('leavetypes.name')
                    ->label('Reason')
                    ->sortable() 
                    ->searchable(),
                Tables\Columns\TextColumn::make('from')
                    ->sortable(), 
                Tables\Columns\TextColumn::make('to')
                    ->sortable(),
                Tables\Columns\TextColumn::make('description'),
                ToggleColumn::make('is_approved')
                    ->label('Approved'),
            ])
            ->filters([
                TernaryFilter::make('is_approved')
                    ->label('Approved'),
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
            'index' => Pages\ListLeaveRequests::route('/'),
            'create' => Pages\CreateLeaveRequests::route('/create'),
            'edit' => Pages\EditLeaveRequests::route('/{record}/edit'),
        ];
    }
}