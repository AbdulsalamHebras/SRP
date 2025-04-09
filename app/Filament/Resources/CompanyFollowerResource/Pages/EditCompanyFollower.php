<?php

namespace App\Filament\Resources\CompanyFollowerResource\Pages;

use App\Filament\Resources\CompanyFollowerResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCompanyFollower extends EditRecord
{
    protected static string $resource = CompanyFollowerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
