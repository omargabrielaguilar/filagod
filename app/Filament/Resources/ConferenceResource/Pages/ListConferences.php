<?php

namespace App\Filament\Resources\ConferenceResource\Pages;

use App\Filament\Resources\ConferenceResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Contracts\Container\BindingResolutionException;

class ListConferences extends ListRecords
{
    protected static string $resource = ConferenceResource::class;

    /**
     * @return array<string|int, \Filament\Actions\Action|\Filament\Actions\ActionGroup> 
     * @throws BindingResolutionException 
     */
    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
