<?php

namespace App\Filament\Resources\CompanyFollowerResource\Pages;

use App\Filament\Resources\CompanyFollowerResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCompanyFollowers extends ListRecords
{
    protected static string $resource = CompanyFollowerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
