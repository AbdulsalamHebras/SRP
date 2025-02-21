<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="{{asset('tinymce/js/tinymce/tinymce.min.js')}}"></script>
    <title> تعديل بيانات {{$company->name}}</title>
</head>
<body>
    @include('includes.header')
    <form method="POST"  enctype="multipart/form-data">
            @csrf
            <input type="text" name="name" placeholder="اسم المستخدم" id="name"
                class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $company->name }}"
                required autocomplete="name" autofocus>
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            <input type="text" name="email" placeholder="البريد الإلكتروني" id="email"
                class="form-control @error('email') is-invalid @enderror"
                value="{{ old('email') }}" required autocomplete="email">
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            <select id="userType" name="accountType" required>
                <option value="">نوع الحساب</option>
                <option value="applier">باحث عن عمل</option>
                <option value="company">شركة</option>
            </select>
            @error('accountType')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <input type="password" name="password" placeholder="كلمة المرور" id="password"
                class="form-control @error('password') is-invalid @enderror"
                required autocomplete="new-password">
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            <input type="password" name="password_confirmation" placeholder="تأكيد كلمة المرور" id="password_confirmation" required autocomplete="new-password">
            @error('password_confirmation')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <div id="company-container">
                <select name="jobField" id="jobField" class="form-control @error('jobField') is-invalid @enderror">
                    <option value="" disabled selected>اختر مجال العمل</option>
                    <option value="Agriculture & Farming">الزراعة والثروة الحيوانية</option>
                    <option value="Fishing & Aquaculture">الصيد وتربية الأحياء المائية</option>
                    <option value="Forestry & Logging">الغابات وقطع الأشجار</option>
                    <option value="Mining & Quarrying">التعدين واستخراج المعادن</option>
                    <option value="Oil & Gas Extraction">استخراج النفط والغاز</option>
                    <option value="Automotive Manufacturing">صناعة السيارات</option>
                    <option value="Aerospace & Defense">الطيران والدفاع</option>
                    <option value="Construction & Civil Engineering">البناء والهندسة المدنية</option>
                    <option value="Electronics & Semiconductors">الإلكترونيات وأشباه الموصلات</option>
                    <option value="Energy Production">إنتاج الطاقة</option>
                    <option value="Food & Beverage Processing">تصنيع الأغذية والمشروبات</option>
                    <option value="Machinery & Equipment Manufacturing">تصنيع الآلات والمعدات</option>
                    <option value="Metal & Steel Industry">صناعة المعادن والصلب</option>
                    <option value="Textile & Apparel Manufacturing">صناعة النسيج والملابس</option>
                    <option value="Chemical Industry">الصناعات الكيميائية</option>
                    <option value="Pharmaceuticals & Biotechnology">الصيدلة والتكنولوجيا الحيوية</option>
                    <option value="Banking & Finance">البنوك والتمويل</option>
                    <option value="Insurance">التأمين</option>
                    <option value="Real Estate & Property Development">العقارات والتطوير العقاري</option>
                    <option value="Retail & E-commerce">التجارة الإلكترونية والتجزئة</option>
                    <option value="Wholesale Trade">التجارة بالجملة</option>
                    <option value="Hospitality & Tourism">الضيافة والسياحة</option>
                    <option value="Healthcare & Medical Services">الرعاية الصحية والخدمات الطبية</option>
                    <option value="Transportation & Logistics">النقل والخدمات اللوجستية</option>
                    <option value="Education & Training">التعليم والتدريب</option>
                    <option value="Media & Entertainment">الإعلام والترفيه</option>
                    <option value="Telecommunications">الاتصالات</option>
                    <option value="Consulting & Professional Services">الاستشارات والخدمات المهنية</option>
                    <option value="Law & Legal Services">القانون والخدمات القانونية</option>
                    <option value="Information Technology & Software Development">تكنولوجيا المعلومات وتطوير البرمجيات</option>
                    <option value="Cybersecurity">الأمن السيبراني</option>
                    <option value="Artificial Intelligence & Machine Learning">الذكاء الاصطناعي وتعلم الآلة</option>
                    <option value="Research & Development (R&D)">البحث والتطوير</option>
                    <option value="Data Science & Analytics">علم البيانات والتحليلات</option>
                    <option value="Digital Marketing & Advertising">التسويق الرقمي والإعلانات</option>
                    <option value="Cloud Computing & Hosting Services">الحوسبة السحابية وخدمات الاستضافة</option>
                    <option value="Government & Public Administration">الحكومة والإدارة العامة</option>
                    <option value="Nonprofit Organizations & NGOs">المنظمات غير الربحية والمنظمات غير الحكومية</option>
                    <option value="International Organizations">المنظمات الدولية</option>
                    <option value="Think Tanks & Policy Research">مراكز الأبحاث والسياسات</option>
                </select>
                @error('jobField')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
                <select name="location" id="location" class="form-control @error('location') is-invalid @enderror">
                    <option value="" disabled selected>اختر المحافظة</option>
                    <option value="صنعاء" {{ old('location') == 'صنعاء' ? 'selected' : '' }}>صنعاء</option>
                    <option value="عدن" {{ old('location') == 'عدن' ? 'selected' : '' }}>عدن</option>
                    <option value="تعز" {{ old('location') == 'تعز' ? 'selected' : '' }}>تعز</option>
                    <option value="الحديدة" {{ old('location') == 'الحديدة' ? 'selected' : '' }}>الحديدة</option>
                    <option value="المكلا" {{ old('location') == 'المكلا' ? 'selected' : '' }}>المكلا</option>
                    <option value="إب" {{ old('location') == 'إب' ? 'selected' : '' }}>إب</option>
                    <option value="سيئون" {{ old('location') == 'سيئون' ? 'selected' : '' }}>سيئون</option>
                    <option value="الغيضة" {{ old('location') == 'الغيضة' ? 'selected' : '' }}>الغيضة</option>
                    <option value="ذمار" {{ old('location') == 'ذمار' ? 'selected' : '' }}>ذمار</option>
                    <option value="حجة" {{ old('location') == 'حجة' ? 'selected' : '' }}>حجة</option>
                </select>
                @error('location')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
                <label for="mission">المهمة</label>
                <textarea name="mission" id="mission" placeholder="المهمة"
                class="form-control @error('mission') is-invalid @enderror">{{ old('mission') }}</textarea>
                @error('mission')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
                <label for="vision">الرؤية</label>
                <textarea name="vision" placeholder="الرؤية" id="vision"
                    class="form-control @error('vision') is-invalid @enderror">{{ old('vision') }}</textarea>
                @error('vision')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
                <label for="aboutus">نبذة عن الشركة</label>
                <textarea name="aboutus" placeholder="نبذة عن الشركة" id="aboutus"
                    class="form-control @error('aboutus') is-invalid @enderror">{{ old('aboutus') }}</textarea>
                @error('aboutus')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
                <label for="dateOfCreation">تاريخ انشاء الشركة</label>
                <input type="date" name="dateOfCreation" id="dateOfCreation"
                    class="form-control @error('dateOfCreation') is-invalid @enderror" value="{{ old('dateOfCreation') }}">
                @error('dateOfCreation')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
                <input type="text" name="phoneNumber" placeholder="رقم الهاتف" id="phoneNumber"
                    class="form-control @error('phoneNumber') is-invalid @enderror" value="{{ old('phoneNumber') }}">
                @error('phoneNumber')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror

                <input type="url" name="website" placeholder="الموقع الإلكتروني" id="website"
                    class="form-control @error('website') is-invalid @enderror" value="{{ old('website') }}">
                @error('website')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
                <label for="logo">شعار الشركة</label>
                <input type="file" name="logo" id="logo">
                @error('logo')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
                <label for="record">ارفق صورة للسجل التجاري</label>
                <input type="file" name="commercialRegister" id="record">
                @error('commercialRegister')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <button type="submit" class="btn">إنشاء</button>
        </form>
    @include('includes.footer')

</body>
</html>
