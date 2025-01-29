<?php

namespace App\Filament\Resources\ApplierResource\Pages;

use App\Filament\Resources\ApplierResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewApplier extends ViewRecord
{
    protected static string $resource = ApplierResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
