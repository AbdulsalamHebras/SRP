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
use Filament\Forms\Components\FileUpload;
use Illuminate\Support\Facades\Hash;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;



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
                    ->unique(ignoreRecord: true)
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->unique(ignoreRecord: true)
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('password')
                    ->password()
                    ->dehydrateStateUsing(fn (?string $state): string => $state ? Hash::make($state) : $state)
                    ->dehydrated(fn (?string $state): bool => filled($state))
                    ->maxLength(12)
                    ->minlength(8)
                    ->nullable(),
                Select::make('jobField')
                    ->label('مجال العمل') // اختيار تسمية الحقل
                    ->options([
                        'Agriculture & Farming' => 'الزراعة والثروة الحيوانية',
                        'Fishing & Aquaculture' => 'الصيد وتربية الأحياء المائية',
                        'Forestry & Logging' => 'الغابات وقطع الأشجار',
                        'Mining & Quarrying' => 'التعدين واستخراج المعادن',
                        'Oil & Gas Extraction' => 'استخراج النفط والغاز',
                        'Automotive Manufacturing' => 'صناعة السيارات',
                        'Aerospace & Defense' => 'الطيران والدفاع',
                        'Construction & Civil Engineering' => 'البناء والهندسة المدنية',
                        'Electronics & Semiconductors' => 'الإلكترونيات وأشباه الموصلات',
                        'Energy Production' => 'إنتاج الطاقة',
                        'Food & Beverage Processing' => 'تصنيع الأغذية والمشروبات',
                        'Machinery & Equipment Manufacturing' => 'تصنيع الآلات والمعدات',
                        'Metal & Steel Industry' => 'صناعة المعادن والصلب',
                        'Textile & Apparel Manufacturing' => 'صناعة النسيج والملابس',
                        'Chemical Industry' => 'الصناعات الكيميائية',
                        'Pharmaceuticals & Biotechnology' => 'الصيدلة والتكنولوجيا الحيوية',
                        'Banking & Finance' => 'البنوك والتمويل',
                        'Insurance' => 'التأمين',
                        'Real Estate & Property Development' => 'العقارات والتطوير العقاري',
                        'Retail & E-commerce' => 'التجارة الإلكترونية والتجزئة',
                        'Wholesale Trade' => 'التجارة بالجملة',
                        'Hospitality & Tourism' => 'الضيافة والسياحة',
                        'Healthcare & Medical Services' => 'الرعاية الصحية والخدمات الطبية',
                        'Transportation & Logistics' => 'النقل والخدمات اللوجستية',
                        'Education & Training' => 'التعليم والتدريب',
                        'Media & Entertainment' => 'الإعلام والترفيه',
                        'Telecommunications' => 'الاتصالات',
                        'Consulting & Professional Services' => 'الاستشارات والخدمات المهنية',
                        'Law & Legal Services' => 'القانون والخدمات القانونية',
                        'Information Technology & Software Development' => 'تكنولوجيا المعلومات وتطوير البرمجيات',
                        'Cybersecurity' => 'الأمن السيبراني',
                        'Artificial Intelligence & Machine Learning' => 'الذكاء الاصطناعي وتعلم الآلة',
                        'Research & Development (R&D)' => 'البحث والتطوير',
                        'Data Science & Analytics' => 'علم البيانات والتحليلات',
                        'Digital Marketing & Advertising' => 'التسويق الرقمي والإعلانات',
                        'Cloud Computing & Hosting Services' => 'الحوسبة السحابية وخدمات الاستضافة',
                        'Government & Public Administration' => 'الحكومة والإدارة العامة',
                        'Nonprofit Organizations & NGOs' => 'المنظمات غير الربحية والمنظمات غير الحكومية',
                        'International Organizations' => 'المنظمات الدولية',
                        'Think Tanks & Policy Research' => 'مراكز الأبحاث والسياسات',
                    ])
                    ->required()
                    ->searchable(),
                Select::make('location')
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
                    ])
                    ->required()
                    ->searchable(),
                Forms\Components\DatePicker::make('dateOfCreation')
                    ->required()
                    ->native(false)
                    ->displayFormat('Y-m-d')
                    ->format('Y-m-d')
                    ->maxDate(now()),
                RichEditor::make('mission')
                        ->maxLength(255)
                        ->required()
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
                        ->required()
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

                RichEditor::make('aboutus')
                    ->maxLength(255)
                    ->required()
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
                    ->maxSize(5120)
                    ->required()
                    ->visibility('public')
                    ->disk('logos')
                    ->directory('')
                    ->openable()
                    ->downloadable(),
                Forms\Components\FileUpload::make('commercialRegister')
                    ->required()
                    ->preserveFilenames()
                    ->acceptedFileTypes(['image/png', 'image/jpeg','image/jpg', 'application/pdf'])
                    ->maxSize(size: 5120)
                    ->disk('records')
                    ->directory('')
                    ->openable()
                    ->downloadable()
                    ->visibility('public') ,
                Forms\Components\TextInput::make('phoneNumber')
                    ->tel()
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(13)
                    ->placeholder('7XXXXXXXX')
                    ->rules([
                        'required',
                        'regex:/^7(8|7|1|0|3)\d{7}$/'
                    ])
                    ->helperText('Enter a valid Yemeni phone number (e.g., 77XXXXXXX, 78XXXXXXX, 70XXXXXXXX,73XXXXXXXX,71XXXXXXXX)')
                    ->prefixIcon('heroicon-o-phone'),
                Forms\Components\TextInput::make('website')
                    ->maxLength(255)
                    ->required()
                    ->url()
                    ->unique(ignoreRecord: true)
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
                Tables\Columns\TextColumn::make('location')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('mission')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('vision')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('dateOfCreation')
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
