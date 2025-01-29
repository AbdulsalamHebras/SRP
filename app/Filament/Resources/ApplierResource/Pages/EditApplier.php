<?php

namespace App\Filament\Resources\ApplierResource\Pages;

use App\Filament\Resources\ApplierResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditApplier extends EditRecord
{
    protected static string $resource = ApplierResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
