<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ScheduleResource\Pages;
use App\Filament\Resources\ScheduleResource\RelationManagers;
use App\Models\Schedule;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Forms\Components\TextInput;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TimePicker;

class ScheduleResource extends Resource
{
    protected static ?string $model = Schedule::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar';
    protected static ?string $recordTitleAttribute = 'name';
    protected static ?string $navigationLabel = 'Schedules'; 
    protected static ?int $navigationSort = 5;
    protected static ?string $navigationGroup = 'Attendance';
    

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name') 
                    ->required(),
                TimePicker::make('amin')
                    ->label('AM IN')
                    ->seconds(false)
                    ->datalist([
                        '00:00','01:00','02:00','03:00','04:00','05:00','06:00','07:00',
                        '08:00','09:00','10:00','11:00','12:00','13:00','14:00','15:00',
                        '16:00','17:00','18:00','19:00','20:00','21:00','22:00','23:00',
                    ]),
                TimePicker::make('amout')
                    ->label('AM OUT')
                    ->seconds(false)
                    ->datalist([
                        '00:00','01:00','02:00','03:00','04:00','05:00','06:00','07:00',
                        '08:00','09:00','10:00','11:00','12:00','13:00','14:00','15:00',
                        '16:00','17:00','18:00','19:00','20:00','21:00','22:00','23:00',
                    ]), 
                TimePicker::make('pmin')
                    ->label('PM IN')
                    ->seconds(false)
                    ->datalist([
                        '00:00','01:00','02:00','03:00','04:00','05:00','06:00','07:00',
                        '08:00','09:00','10:00','11:00','12:00','13:00','14:00','15:00',
                        '16:00','17:00','18:00','19:00','20:00','21:00','22:00','23:00',
                    ]),
                TimePicker::make('pmout')
                    ->label('PM OUT')
                    ->seconds(false)
                    ->datalist([
                        '00:00','01:00','02:00','03:00','04:00','05:00','06:00','07:00',
                        '08:00','09:00','10:00','11:00','12:00','13:00','14:00','15:00',
                        '16:00','17:00','18:00','19:00','20:00','21:00','22:00','23:00',
                    ]),
                TimePicker::make('outinthemorning')
                    ->label('Out in the Morning')
                    ->seconds(false)
                    ->datalist([
                        '00:00','01:00','02:00','03:00','04:00','05:00','06:00','07:00',
                        '08:00','09:00','10:00','11:00','12:00','13:00','14:00','15:00',
                        '16:00','17:00','18:00','19:00','20:00','21:00','22:00','23:00',
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->sortable() 
                    ->searchable(),
                Tables\Columns\TextColumn::make('amin') 
                    ->label('AM IN'), 
                Tables\Columns\TextColumn::make('amout') 
                    ->label('AM OUT'),  
                Tables\Columns\TextColumn::make('pmin') 
                    ->label('PM IN'), 
                Tables\Columns\TextColumn::make('pmout') 
                    ->label('PM OUT'), 
                Tables\Columns\TextColumn::make('outinthemorning') 
                    ->label('Out in the Morning'), 
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
            'index' => Pages\ListSchedules::route('/'),
            'create' => Pages\CreateSchedule::route('/create'),
            'edit' => Pages\EditSchedule::route('/{record}/edit'),
        ];
    }
}
