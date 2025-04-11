<?php

namespace App\Filament\Resources\ApplierResource\Pages;

use App\Filament\Resources\ApplierResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Hash;


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
    protected function afterSave(): void
    {
        $applier = $this->record;

        $user = $applier->user()->first();

        if ($user) {
            $user->update([
                'name' => $applier->name,
                'email' => $applier->email,
                'password' => $applier->password
                    ? (Hash::needsRehash($applier->password) ? Hash::make($applier->password) : $applier->password)
                    : $user->password, 
            ]);
        }
    }
}
