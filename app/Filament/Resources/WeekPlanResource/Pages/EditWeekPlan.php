<?php

namespace App\Filament\Resources\WeekPlanResource\Pages;

use App\Filament\Resources\WeekPlanResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditWeekPlan extends EditRecord
{
    protected static string $resource = WeekPlanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
