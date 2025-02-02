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
use Filament\Forms\Components\RichEditor;

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
                    ->maxLength(10),
                Forms\Components\TextInput::make('jobField')
                    ->maxLength(255)
                    ->required(),
                RichEditor::make('mission')
                        ->maxLength(255)
                        ->default(null)
                        ->toolbarButtons([
                            'bold',
                            'italic',
                            'underline',
                            'strike',
                            'link',
                            'orderedList',
                            'unorderedList',
                            'blockquote',
                        ]),
                RichEditor::make('vision')
                        ->maxLength(255)
                        ->default(null)
                        ->toolbarButtons([
                            'bold',
                            'italic',
                            'underline',
                            'strike',
                            'link',
                            'orderedList',
                            'unorderedList',
                            'blockquote',
                        ]),
                Forms\Components\DatePicker::make('dataOfCreation')
                    ->required()
                    ->native(false)
                    ->displayFormat('Y-m-d')
                    ->format('Y-m-d'),
                RichEditor::make('aboutus')
                    ->maxLength(255)
                    ->default(null)
                    ->toolbarButtons([
                        'bold',
                        'italic',
                        'underline',
                        'strike',
                        'link',
                        'orderedList',
                        'unorderedList',
                        'blockquote',
                    ]),
                Forms\Components\FileUpload::make('logo')
                    ->preserveFilenames()
                    ->image()
                    ->minSize(512)
                    ->maxSize(5120)
                    ->default(null),
                Forms\Components\FileUpload::make('commercialRegister')
                    ->required()
                    ->preserveFilenames()
                    ->acceptedFileTypes(['png/jpg/pdf'])
                    ->minSize(512)
                    ->maxSize(5120),
                Forms\Components\TextInput::make('phoneNumber')
                    ->tel()
                    ->required()
                    ->maxLength(255)
                    ->placeholder('+9677XXXXXXXX')
                    ->rules([
                        'required',
                        '   regex:/^\+967(7\d{7}|3\d{7}|1\d{7}|8\d{7}|0\d{7})$/'
                    ])
                    ->helperText('Enter a valid Yemeni phone number (e.g., +9677XXXXXXXX, +9678XXXXXXXX, +9670XXXXXXXX)')
                    ->prefixIcon('heroicon-o-phone'),
                Forms\Components\TextInput::make('website')
                    ->maxLength(255)
                    ->default(null)
                    ->url()
                    ->placeholder('https://example.com')
                    ->suffixIcon('heroicon-o-globe-alt'),
                Forms\Components\Toggle::make('isAccepted')
                    ->required(),
                Forms\Components\TextInput::make('jobsNumber')
                    ->required()
                    ->numeric()
                    ->readOnly()
                    ->default(0),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('jobField')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('mission')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('vision')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('dataOfCreation')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('aboutus')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('logo')
                ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('phoneNumber')
                    ->searchable(),
                Tables\Columns\TextColumn::make('website')
                    ->searchable(),
                Tables\Columns\TextColumn::make('commercialRegister')
                    // ->openable()
                    // ->downloadable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\IconColumn::make('isAccepted')
                    ->boolean()
                    ->sortable(),
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
