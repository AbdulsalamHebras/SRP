<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Hash;


class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
    protected function afterSave(): void
    {
        $user = $this->record;

        if ($user->applier) {
            $user->applier->update([
                'name' => $user->name,
                'email' => $user->email,
                'password' => $user->password
                    ? (Hash::needsRehash($user->password) ? Hash::make($user->password) : $user->password)
                    : $user->applier->password, // إذا لم تتغير، نترك القيمة كما هي
            ]);
        }
    }
}
