<?php

namespace App\Filament\Resources\HouseHoldResource\Pages;

use App\Filament\Resources\HouseHoldResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditHouseHold extends EditRecord
{
    protected static string $resource = HouseHoldResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
