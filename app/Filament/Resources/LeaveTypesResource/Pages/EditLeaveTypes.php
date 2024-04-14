<?php

namespace App\Filament\Resources\LeaveTypesResource\Pages;

use App\Filament\Resources\LeaveTypesResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLeaveTypes extends EditRecord
{
    protected static string $resource = LeaveTypesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
