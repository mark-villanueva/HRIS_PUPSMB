<?php

namespace App\Filament\Resources\LeaveRequestsResource\Pages;

use App\Filament\Resources\LeaveRequestsResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\EditRecord;
use  \EightyNine\Approvals\Traits\HasApprovalHeaderActions;

class EditLeaveRequests extends EditRecord
{
    protected static string $resource = LeaveRequestsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

     /**
     * Get the completion action.
     *
     * @return Filament\Actions\Action
     * @throws Exception
     */
    protected function getOnCompletionAction(): Action
    {
        return Action::make("Done")
            ->color("success")
            // Do not use the visible method, since it is being used internally to show this action if the approval flow has been completed.
            // Using the hidden method add your condition to prevent the action from being performed more than once
            ->hidden(fn(ApprovableModel $record)=> $record->shouldBeHidden());
    }
}
