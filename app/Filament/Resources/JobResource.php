<?php

namespace App\Filament\Resources;

use App\Filament\Resources\JobResource\Pages;
use App\Filament\Resources\JobResource\RelationManagers;
use App\Models\Job;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Illuminate\Validation\ValidationException;


class JobResource extends Resource
{
    protected static ?string $model = Job::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('jobName')
                    ->required()
                    ->maxLength(255)
                    ->rules(['required', 'string', 'max:255']),

                Forms\Components\RichEditor::make('description')
                    ->required()
                    ->rules(['required', 'string', 'min:20'])
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

                Select::make('jobType')
                    ->required()
                    ->options([
                        'دوام كلي ' => 'دوام كلي ',
                        'دوام جزئي' => 'دوام جزئي',
                        'عن بعد' => 'عن بعد',
                    ]),

                Forms\Components\TextInput::make('minSalary')
                    ->required()
                    ->numeric()
                    ->lte('minSalary')
                    ->rules(['numeric', 'min:0']),

                Forms\Components\TextInput::make('maxSalary')
                    ->required()
                    ->numeric()
                    ->gte('minSalary')
                    ->rules(['numeric']),

                Select::make('currency')
                    ->required()
                    ->options([
                        'YEM' => 'ريال يمني',
                        'SAY' => 'ريال سعودي',
                        'USD' => 'دولار امريكي ',
                    ])
                    ->rules(['required', 'in:YEM,SAR,USD']),

                Forms\Components\Select::make('company_id')
                    ->required()
                    ->options(fn () => \App\Models\Company::pluck('name', 'id')->toArray()),

                Forms\Components\RichEditor::make('requirements')
                    ->required()
                    ->rules(['required', 'string', 'min:20'])
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

                Forms\Components\DatePicker::make('expirationDate')
                    ->required()
                    ->rules(['required', 'date', 'after:today']),

                Select::make('location')
                    ->required()
                    ->rules(['required_unless:jobType,عن بعد', 'string', 'max:255'])
                    ->options([
                        'Aden' => 'عدن',
                        'Sana\'a' => 'صنعاء',
                        'Taiz' => 'تعز',
                        'Al Hudaydah' => 'الحديدة',
                        'Ibb' => 'إب',
                        'Hadramout' => 'حضرموت',
                        'Dhamar' => 'ذمار',
                        'Al Mahwit' => 'المحويت',
                        'Al Bayda' => 'البيضاء',
                        'Amran' => 'عمران',
                        'Lahij' => 'لحج',
                        'Al Jawf' => 'الجوف',
                        'Saada' => 'صعدة',
                        'Al Mahrah' => 'المهرة',
                        'Marib' => 'مأرب',
                        'Shabwah' => 'شبوة',
                        'Raymah' => 'ريمة',
                        'Hajjah' => 'حجة',
                        'Al Dhale\'e' => 'الضالع',
                        'Socotra' => 'سقطرى',
                        'remote' => 'عن بعد',
                    ])
                    ->searchable(),

                Forms\Components\TextInput::make('reqGrade')
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
                Tables\Columns\TextColumn::make('jobName')
                    ->searchable(),
                Tables\Columns\TextColumn::make('jobType')
                    ->searchable(),
                Tables\Columns\TextColumn::make('minSalary')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('maxSalary')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('currency')
                    ->searchable(),
                Tables\Columns\TextColumn::make('company_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('expirationDate')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('location')
                    ->searchable(),
                Tables\Columns\TextColumn::make('reqGrade')
                    ->numeric()
                    ->sortable(),
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
            'index' => Pages\ListJobs::route('/'),
            'create' => Pages\CreateJob::route('/create'),
            'view' => Pages\ViewJob::route('/{record}'),
            'edit' => Pages\EditJob::route('/{record}/edit'),
        ];
    }
}
