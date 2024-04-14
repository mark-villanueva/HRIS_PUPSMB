<?php

namespace App\Filament\Resources\TardinessResource\Pages;

use App\Filament\Resources\TardinessResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTardiness extends EditRecord
{
    protected static string $resource = TardinessResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
