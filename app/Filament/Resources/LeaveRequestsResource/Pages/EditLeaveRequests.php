<?php

namespace App\Filament\Resources\LeaveRequestsResource\Pages;

use App\Filament\Resources\LeaveRequestsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLeaveRequests extends EditRecord
{
    protected static string $resource = LeaveRequestsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
