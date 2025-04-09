<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CompanyFollowerResource\Pages;
use App\Filament\Resources\CompanyFollowerResource\RelationManagers;
use App\Models\Company_follower;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CompanyFollowerResource extends Resource
{
    protected static ?string $model = Company_follower::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('company_id')
                ->label('Company Name')
                ->required()
                ->options(function () {
                    return \App\Models\Company::all()->pluck('name', 'id')->toArray();
                }),

            Forms\Components\Select::make('user_id')
                ->label('User Name')
                ->required()
                ->options(function () {
                    return \App\Models\User::all()->pluck('name', 'id')->toArray();
                }),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('applier.name')
                    ->label('Applier Name')
                    ->sortable(),

                Tables\Columns\TextColumn::make('user.name')
                    ->label('User Name')
                    ->sortable(),
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
            'index' => Pages\ListCompanyFollowers::route('/'),
            'create' => Pages\CreateCompanyFollower::route('/create'),
            'view' => Pages\ViewCompanyFollower::route('/{record}'),
            'edit' => Pages\EditCompanyFollower::route('/{record}/edit'),
        ];
    }
}
