<?php

namespace App\Filament\Resources\LeaveRequestsResource\Pages;

use App\Filament\Resources\LeaveRequestsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLeaveRequests extends ListRecords
{
    protected static string $resource = LeaveRequestsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
