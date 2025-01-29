<?php

namespace App\Filament\Resources\ApplierResource\Pages;

use App\Filament\Resources\ApplierResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAppliers extends ListRecords
{
    protected static string $resource = ApplierResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
