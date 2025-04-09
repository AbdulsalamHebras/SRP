<?php

namespace App\Filament\Resources;

use App\Filament\Resources\JobApplierResource\Pages;
use App\Filament\Resources\JobApplierResource\RelationManagers;
use App\Models\jobs_appliers;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class JobApplierResource extends Resource
{
    protected static ?string $model = jobs_appliers::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('applier_id')
                ->label('Applier Name')
                ->required()
                ->options(function () {
                    return \App\Models\Applier::all()->pluck('name', 'id')->toArray();
                }),

            Forms\Components\Select::make('job_id')
                ->label('Job Name')
                ->required()
                ->options(function () {
                    return \App\Models\Job::all()->pluck('jobName', 'id')->toArray();
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

                Tables\Columns\TextColumn::make('job.jobName')
                    ->label('Job Name')
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
            'index' => Pages\ListJobAppliers::route('/'),
            'create' => Pages\CreateJobApplier::route('/create'),
            'view' => Pages\ViewJobApplier::route('/{record}'),
            'edit' => Pages\EditJobApplier::route('/{record}/edit'),
        ];
    }
}
