<?php

namespace App\Filament\Resources\JobApplierResource\Pages;

use App\Filament\Resources\JobApplierResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewJobApplier extends ViewRecord
{
    protected static string $resource = JobApplierResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
