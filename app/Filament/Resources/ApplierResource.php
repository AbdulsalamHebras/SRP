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
use Filament\Forms\Components\{TextInput, DatePicker, FileUpload, Select, CheckboxList};
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rule;
use Filament\Forms\Components\Group;

class ApplierResource extends Resource
{
    protected static ?string $model = Applier::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),

                TextInput::make('email')
                    ->required()
                    ->email()
                    ->unique('appliers', 'email', ignoreRecord: true)
                    ->maxLength(255),

                TextInput::make('password')
                    ->password()
                    ->dehydrateStateUsing(fn (?string $state): string => $state ? Hash::make($state) : $state)
                    ->dehydrated(fn (?string $state): bool => filled($state))
                    ->nullable()
                    ->rule(Password::defaults())
                    ->rule('regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/'),

                

                TextInput::make('phoneNumber')
                    ->required()
                    ->numeric()
                    ->rule('digits:9')
                    ->rule('regex:/^(77|78|71|73|70)\d{7}$/')
                    ->unique('appliers', 'phoneNumber', ignoreRecord: true),

                TextInput::make('city')
                    ->required()
                    ->maxLength(255),

                TextInput::make('address')
                    ->required()
                    ->maxLength(255),

                TextInput::make('age')
                    ->nullable()
                    ->numeric()
                    ->minValue(18)
                    ->maxValue(99),

                DatePicker::make('DOB')
                    ->label('Date of birth')
                    ->nullable(),

                DatePicker::make('graduationDate')
                    ->nullable(),

                Select::make('degree')
                    ->nullable()
                    ->options([
                        'bachelor' => 'بكالوريوس',
                        'master' => 'ماجستير',
                        'phd' => 'دكتوراه',
                        'other' => 'أخرى',
                    ]),

                Group::make([
                    Select::make('specialization')
                        ->options([
                            'علوم الحاسوب' => 'علوم الحاسوب',
                            'الذكاء الاصطناعي' => 'الذكاء الاصطناعي',
                            'الأمن السيبراني' => 'الأمن السيبراني',
                            'تحليل البيانات' => 'تحليل البيانات',
                            'هندسة البرمجيات' => 'هندسة البرمجيات',
                            'الروبوتات' => 'الروبوتات',
                            'الهندسة الكهربائية' => 'الهندسة الكهربائية',
                            'الهندسة الميكانيكية' => 'الهندسة الميكانيكية',
                            'الهندسة الطبية الحيوية' => 'الهندسة الطبية الحيوية',
                            'الهندسة المدنية' => 'الهندسة المدنية',
                            'الهندسة الكيميائية' => 'الهندسة الكيميائية',
                            'الفيزياء التطبيقية' => 'الفيزياء التطبيقية',
                            'علوم الأحياء' => 'علوم الأحياء',
                            'الطب والجراحة' => 'الطب والجراحة',
                            'الصيدلة' => 'الصيدلة',
                            'التغذية وعلم الغذاء' => 'التغذية وعلم الغذاء',
                            'الاقتصاد' => 'الاقتصاد',
                            'إدارة الأعمال' => 'إدارة الأعمال',
                            'التسويق الرقمي' => 'التسويق الرقمي',
                            'المحاسبة' => 'المحاسبة',
                            'القانون والتشريعات' => 'القانون والتشريعات',
                            'العلاقات الدولية' => 'العلاقات الدولية',
                            'الإعلام والاتصال' => 'الإعلام والاتصال',
                            'التصميم الجرافيكي' => 'التصميم الجرافيكي',
                            'تصميم تجربة المستخدم (UX/UI)' => 'تصميم تجربة المستخدم (UX/UI)',
                            'الواقع الافتراضي والواقع المعزز' => 'الواقع الافتراضي والواقع المعزز',
                            'الطاقة المتجددة' => 'الطاقة المتجددة',
                            'إدارة المشاريع' => 'إدارة المشاريع',
                            'علم النفس' => 'علم النفس',
                            'التربية والتعليم' => 'التربية والتعليم',
                            'اللغويات والترجمة' => 'اللغويات والترجمة',
                            'علوم الفضاء والفلك' => 'علوم الفضاء والفلك',
                            'other' => 'أخرى',
                        ])
                        ->searchable()
                        ->nullable()
                        ->reactive(),

                    TextInput::make('custom_specialization')
                        ->required(fn ($get) => $get('specialization') === 'other')
                        ->visible(fn ($get) => $get('specialization') === 'other'),
                        ]),

                FileUpload::make('CVfile')
                    ->nullable()
                    ->acceptedFileTypes(['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'])
                    ->maxSize(10240), // 10 MB

                FileUpload::make('photo')
                    ->nullable()
                    ->image()
                    ->imageEditor()
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/jpg'])
                    ->maxSize(5120), // 5 MB

                Select::make('gender')
                    ->required()
                    ->options([
                        'male' => 'Male',
                        'female' => 'Female',
                    ])
                    ->native(false),

                Select::make('languages')
                    ->label('اللغات')
                    ->multiple()
                    ->options([
                        'Arabic' => 'العربية',
                        'English' => 'الإنجليزية',
                        'French' => 'الفرنسية',
                        'German' => 'الألمانية',
                        'Spanish' => 'الإسبانية',
                        'Other' => 'أخرى',
                    ])
                    ->searchable()
                    ->preload()
                    ->nullable(),
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
