<?php

namespace App\Filament\Resources\JobApplierResource\Pages;

use App\Filament\Resources\JobApplierResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditJobApplier extends EditRecord
{
    protected static string $resource = JobApplierResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
