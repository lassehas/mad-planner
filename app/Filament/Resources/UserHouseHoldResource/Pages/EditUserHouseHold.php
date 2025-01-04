<?php

namespace App\Filament\Resources\UserHouseHoldResource\Pages;

use App\Filament\Resources\UserHouseHoldResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUserHouseHold extends EditRecord
{
    protected static string $resource = UserHouseHoldResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
