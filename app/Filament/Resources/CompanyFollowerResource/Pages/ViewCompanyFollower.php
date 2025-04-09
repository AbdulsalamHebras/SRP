<?php

namespace App\Filament\Resources\CompanyFollowerResource\Pages;

use App\Filament\Resources\CompanyFollowerResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewCompanyFollower extends ViewRecord
{
    protected static string $resource = CompanyFollowerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
