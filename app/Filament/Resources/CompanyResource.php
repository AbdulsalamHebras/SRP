<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CompanyResource\Pages;
use App\Filament\Resources\CompanyResource\RelationManagers;
use App\Models\Company;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CompanyResource extends Resource
{
    protected static ?string $model = Company::class;

    protected static ?string $navigationIcon = 'heroicon-o-home-modern';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('password')
                    ->password()
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('jobField')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('mission')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('vision')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('dataOfCreation')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('aboutus')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\FileUpload::make('logo')
                    
                    ->default(null),
                Forms\Components\TextInput::make('phoneNumber')
                    ->tel()
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('website')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('commercialRegister')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Toggle::make('isAccepted')
                    ->required(),
                Forms\Components\TextInput::make('jobsNumber')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('jobField')
                    ->searchable(),
                Tables\Columns\TextColumn::make('mission')
                    ->searchable(),
                Tables\Columns\TextColumn::make('vision')
                    ->searchable(),
                Tables\Columns\TextColumn::make('dataOfCreation')
                    ->searchable(),
                Tables\Columns\TextColumn::make('aboutus')
                    ->searchable(),
                Tables\Columns\TextColumn::make('logo')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phoneNumber')
                    ->searchable(),
                Tables\Columns\TextColumn::make('website')
                    ->searchable(),
                Tables\Columns\TextColumn::make('commercialRegister')
                    ->searchable(),
                Tables\Columns\IconColumn::make('isAccepted')
                    ->boolean(),
                Tables\Columns\TextColumn::make('jobsNumber')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCompanies::route('/'),
            'create' => Pages\CreateCompany::route('/create'),
            'view' => Pages\ViewCompany::route('/{record}'),
            'edit' => Pages\EditCompany::route('/{record}/edit'),
        ];
    }
}