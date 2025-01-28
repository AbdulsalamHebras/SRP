<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ApplierResource\Pages;
use App\Filament\Resources\ApplierResource\RelationManagers;
use App\Models\Applier;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ApplierResource extends Resource
{
    protected static ?string $model = Applier::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

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
                Forms\Components\TextInput::make('phoneNumber')
                    ->tel()
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('city')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('address')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\DatePicker::make('BOB'),
                Forms\Components\TextInput::make('gender')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('acadmicStudy')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('languages')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('CVfile')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\DatePicker::make('graduationDate'),
                Forms\Components\TextInput::make('age')
                    ->numeric()
                    ->default(null),
                Forms\Components\TextInput::make('photo')
                    ->maxLength(255)
                    ->default(null),
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
                Tables\Columns\TextColumn::make('phoneNumber')
                    ->searchable(),
                Tables\Columns\TextColumn::make('city')
                    ->searchable(),
                Tables\Columns\TextColumn::make('address')
                    ->searchable(),
                Tables\Columns\TextColumn::make('BOB')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('gender')
                    ->searchable(),
                Tables\Columns\TextColumn::make('acadmicStudy')
                    ->searchable(),
                Tables\Columns\TextColumn::make('languages')
                    ->searchable(),
                Tables\Columns\TextColumn::make('CVfile')
                    ->searchable(),
                Tables\Columns\TextColumn::make('graduationDate')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('age')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('photo')
                    ->searchable(),
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
            'index' => Pages\ListAppliers::route('/'),
            'create' => Pages\CreateApplier::route('/create'),
            'view' => Pages\ViewApplier::route('/{record}'),
            'edit' => Pages\EditApplier::route('/{record}/edit'),
        ];
    }
}
