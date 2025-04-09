<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InterviewResource\Pages;
use App\Filament\Resources\InterviewResource\RelationManagers;
use App\Models\Interview;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class InterviewResource extends Resource
{
    protected static ?string $model = Interview::class;

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

            Forms\Components\DatePicker::make('date')
                ->required(),

            Forms\Components\TimePicker::make('time')
                ->required()
                ->format('H:i'),

            Forms\Components\Textarea::make('notes')
                ->columnSpanFull(),
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

                Tables\Columns\TextColumn::make('date')
                    ->date()
                    ->sortable(),

                Tables\Columns\TextColumn::make('time'),

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
            'index' => Pages\ListInterviews::route('/'),
            'create' => Pages\CreateInterview::route('/create'),
            'view' => Pages\ViewInterview::route('/{record}'),
            'edit' => Pages\EditInterview::route('/{record}/edit'),
        ];
    }
}
