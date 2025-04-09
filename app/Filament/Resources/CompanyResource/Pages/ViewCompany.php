<?php

namespace App\Filament\Resources\CompanyResource\Pages;

use App\Filament\Resources\CompanyResource;
use Filament\Resources\Pages\ViewRecord;
use Filament\Forms\Form;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Toggle;
use Filament\Actions;


class ViewCompany extends ViewRecord
{
    protected static string $resource = CompanyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }

    public function form(Form $form): Form
    {
        return $form->schema([
            Card::make([
                TextInput::make('name')->disabled(),
                TextInput::make('email')->disabled(),
                TextInput::make('phoneNumber')->disabled(),
                TextInput::make('website')->disabled(),
                TextInput::make('jobField')->disabled(),
                TextInput::make('location')->disabled(),
                TextInput::make('dateOfCreation')->disabled(),
                Toggle::make('isAccepted')->disabled(),
                TextInput::make('jobsNumber')->disabled(),

                FileUpload::make('logo')
                    ->image()
                    ->disk('logos')
                    ->directory('')
                    ->visibility('public')
                    ->downloadable()
                    ->openable()
                    ->disabled(),

                FileUpload::make('commercialRegister')
                    ->disk('records')
                    ->directory('')
                    ->visibility('public')
                    ->downloadable()
                    ->openable()
                    ->disabled(),
            ]),

            Card::make([
                RichEditor::make('mission')
                    ->disabled(),
                RichEditor::make('vision')
                    ->disabled(),
                RichEditor::make('aboutus')
                    ->disabled(),
            ]),
        ]);
    }
}
