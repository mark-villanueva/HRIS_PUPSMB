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
use Illuminate\Support\Facades\Auth;
use Filament\Actions;
use Filament\Actions\Action;



class LeaveRequestsResource extends Resource
{
    protected static ?string $model = LeaveRequests::class;

    protected static ?int $navigationSort = 2;
    protected static ?string $navigationIcon = 'heroicon-o-document-plus';
    protected static ?string $navigationGroup = 'Leave Management';

    public static function form(Form $form): Form
    {
        $user = Auth::user(); // Get the authenticated user here
        return $form
            ->schema([
        
                Select::make('users_id')
                    ->label('Employee Name')
                    ->relationship('users', 'name')
                    ->options(
                        function () use ($user) {
                            // Return an array containing only the authenticated user
                            return [$user->getKey() => $user->name];
                        }
                    )
                  
                    ->default($user->getKey()) // Set the default value to the authenticated user's ID
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
                Tables\Columns\TextColumn::make('users.name')
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
                \EightyNine\Approvals\Tables\Columns\ApprovalStatusColumn::make("approvalStatus.status"),
                
            ])
            ->filters([
                
            ])
            ->actions([
                ...\EightyNine\Approvals\Tables\Actions\ApprovalActions::make(
                    [
                        Tables\Actions\EditAction::make(),
                        Tables\Actions\ViewAction::make()
                    ]
                ),
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
