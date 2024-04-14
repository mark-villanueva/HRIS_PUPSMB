<?php

namespace App\Filament\Resources\TardinessResource\Pages;

use App\Filament\Resources\TardinessResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTardiness extends ListRecords
{
    protected static string $resource = TardinessResource::class;
    protected static ?string $title = 'Tardiness';
    protected ?string $heading = 'Tardiness';
    
    

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('New Tardiness'),
               
        ];
    }
}
