<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="{{asset('CSS/auth/login.css')}}">
    <script src="{{asset('tinymce/js/tinymce/tinymce.min.js')}}"></script>
</head>
<body>
    <div class="login-container">
        <!-- Logo -->
        <div class="logo">
            <a href="{{route('home')}}">
                <h1>ط<span>موح</span></h1>
            </a>
        </div>
        <!-- Form Fields -->
        <form method="POST"  enctype="multipart/form-data" id="registrationForm"
            data-default-action="{{ route('register') }}"
            data-company-action="{{ route('companies.register') }}">
            @csrf
            <input type="text" name="name" placeholder="اسم المستخدم" id="name"
                class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}"
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
           <!-- كلمة المرور -->
<div style="position: relative;">
    <input type="password" name="password" placeholder="كلمة المرور" id="password"
        class="form-control @error('password') is-invalid @enderror"
        required autocomplete="new-password"
        style="padding-left: 40px;">

    <span onclick="togglePassword('password', 'toggleIcon1')" id="toggleIcon1"
        style="position: absolute; top: 50%; left: 30px; transform: translateY(-50%);
               cursor: pointer; font-size: 18px; color: #666;">
        👁️
    </span>

    @error('password')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>

<!-- تأكيد كلمة المرور -->
<div style="position: relative; margin-top: 15px;">
    <input type="password" name="password_confirmation" placeholder="تأكيد كلمة المرور" id="password_confirmation"
        required autocomplete="new-password"
        style="padding-left: 40px;" class="form-control">

    <span onclick="togglePassword('password_confirmation', 'toggleIcon2')" id="toggleIcon2"
        style="position: absolute; top: 50%; left: 30px; transform: translateY(-50%);
               cursor: pointer; font-size: 18px; color: #666;">
        👁️
    </span>

    @error('password_confirmation')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>

<!-- JavaScript -->
<script>
    function togglePassword(inputId, iconId) {
        const input = document.getElementById(inputId);
        const icon = document.getElementById(iconId);

        if (input.type === "password") {
            input.type = "text";
            icon.textContent = "🙈";
        } else {
            input.type = "password";
            icon.textContent = "👁️";
        }
    }
</script>

            <div id="company-container">
                <select name="jobField" id="jobField" class="form-control @error('jobField') is-invalid @enderror">
                    <option value="" disabled {{ old('jobField') == '' ? 'selected' : '' }}>اختر مجال العمل</option>
                    <option value="Agriculture & Farming" {{ old('jobField') == 'Agriculture & Farming' ? 'selected' : '' }}>الزراعة والثروة الحيوانية</option>
                    <option value="Fishing & Aquaculture" {{ old('jobField') == 'Fishing & Aquaculture' ? 'selected' : '' }}>الصيد وتربية الأحياء المائية</option>
                    <option value="Forestry & Logging" {{ old('jobField') == 'Forestry & Logging' ? 'selected' : '' }}>الغابات وقطع الأشجار</option>
                    <option value="Mining & Quarrying" {{ old('jobField') == 'Mining & Quarrying' ? 'selected' : '' }}>التعدين واستخراج المعادن</option>
                    <option value="Oil & Gas Extraction" {{ old('jobField') == 'Oil & Gas Extraction' ? 'selected' : '' }}>استخراج النفط والغاز</option>
                    <option value="Automotive Manufacturing" {{ old('jobField') == 'Automotive Manufacturing' ? 'selected' : '' }}>صناعة السيارات</option>
                    <option value="Aerospace & Defense" {{ old('jobField') == 'Aerospace & Defense' ? 'selected' : '' }}>الطيران والدفاع</option>
                    <option value="Construction & Civil Engineering" {{ old('jobField') == 'Construction & Civil Engineering' ? 'selected' : '' }}>البناء والهندسة المدنية</option>
                    <option value="Electronics & Semiconductors" {{ old('jobField') == 'Electronics & Semiconductors' ? 'selected' : '' }}>الإلكترونيات وأشباه الموصلات</option>
                    <option value="Energy Production" {{ old('jobField') == 'Energy Production' ? 'selected' : '' }}>إنتاج الطاقة</option>
                    <option value="Food & Beverage Processing" {{ old('jobField') == 'Food & Beverage Processing' ? 'selected' : '' }}>تصنيع الأغذية والمشروبات</option>
                    <option value="Machinery & Equipment Manufacturing" {{ old('jobField') == 'Machinery & Equipment Manufacturing' ? 'selected' : '' }}>تصنيع الآلات والمعدات</option>
                    <option value="Metal & Steel Industry" {{ old('jobField') == 'Metal & Steel Industry' ? 'selected' : '' }}>صناعة المعادن والصلب</option>
                    <option value="Textile & Apparel Manufacturing" {{ old('jobField') == 'Textile & Apparel Manufacturing' ? 'selected' : '' }}>صناعة النسيج والملابس</option>
                    <option value="Chemical Industry" {{ old('jobField') == 'Chemical Industry' ? 'selected' : '' }}>الصناعات الكيميائية</option>
                    <option value="Pharmaceuticals & Biotechnology" {{ old('jobField') == 'Pharmaceuticals & Biotechnology' ? 'selected' : '' }}>الصيدلة والتكنولوجيا الحيوية</option>
                    <option value="Banking & Finance" {{ old('jobField') == 'Banking & Finance' ? 'selected' : '' }}>البنوك والتمويل</option>
                    <option value="Insurance" {{ old('jobField') == 'Insurance' ? 'selected' : '' }}>التأمين</option>
                    <option value="Real Estate & Property Development" {{ old('jobField') == 'Real Estate & Property Development' ? 'selected' : '' }}>العقارات والتطوير العقاري</option>
                    <option value="Retail & E-commerce" {{ old('jobField') == 'Retail & E-commerce' ? 'selected' : '' }}>التجارة الإلكترونية والتجزئة</option>
                    <option value="Wholesale Trade" {{ old('jobField') == 'Wholesale Trade' ? 'selected' : '' }}>التجارة بالجملة</option>
                    <option value="Hospitality & Tourism" {{ old('jobField') == 'Hospitality & Tourism' ? 'selected' : '' }}>الضيافة والسياحة</option>
                    <option value="Healthcare & Medical Services" {{ old('jobField') == 'Healthcare & Medical Services' ? 'selected' : '' }}>الرعاية الصحية والخدمات الطبية</option>
                    <option value="Transportation & Logistics" {{ old('jobField') == 'Transportation & Logistics' ? 'selected' : '' }}>النقل والخدمات اللوجستية</option>
                    <option value="Education & Training" {{ old('jobField') == 'Education & Training' ? 'selected' : '' }}>التعليم والتدريب</option>
                    <option value="Media & Entertainment" {{ old('jobField') == 'Media & Entertainment' ? 'selected' : '' }}>الإعلام والترفيه</option>
                    <option value="Telecommunications" {{ old('jobField') == 'Telecommunications' ? 'selected' : '' }}>الاتصالات</option>
                    <option value="Consulting & Professional Services" {{ old('jobField') == 'Consulting & Professional Services' ? 'selected' : '' }}>الاستشارات والخدمات المهنية</option>
                    <option value="Law & Legal Services" {{ old('jobField') == 'Law & Legal Services' ? 'selected' : '' }}>القانون والخدمات القانونية</option>
                    <option value="Information Technology & Software Development" {{ old('jobField') == 'Information Technology & Software Development' ? 'selected' : '' }}>تكنولوجيا المعلومات وتطوير البرمجيات</option>
                    <option value="Cybersecurity" {{ old('jobField') == 'Cybersecurity' ? 'selected' : '' }}>الأمن السيبراني</option>
                    <option value="Artificial Intelligence & Machine Learning" {{ old('jobField') == 'Artificial Intelligence & Machine Learning' ? 'selected' : '' }}>الذكاء الاصطناعي وتعلم الآلة</option>
                    <option value="Research & Development (R&D)" {{ old('jobField') == 'Research & Development (R&D)' ? 'selected' : '' }}>البحث والتطوير</option>
                    <option value="Data Science & Analytics" {{ old('jobField') == 'Data Science & Analytics' ? 'selected' : '' }}>علم البيانات والتحليلات</option>
                    <option value="Digital Marketing & Advertising" {{ old('jobField') == 'Digital Marketing & Advertising' ? 'selected' : '' }}>التسويق الرقمي والإعلانات</option>
                    <option value="Cloud Computing & Hosting Services" {{ old('jobField') == 'Cloud Computing & Hosting Services' ? 'selected' : '' }}>الحوسبة السحابية وخدمات الاستضافة</option>
                    <option value="Government & Public Administration" {{ old('jobField') == 'Government & Public Administration' ? 'selected' : '' }}>الحكومة والإدارة العامة</option>
                    <option value="Nonprofit Organizations & NGOs" {{ old('jobField') == 'Nonprofit Organizations & NGOs' ? 'selected' : '' }}>المنظمات غير الربحية والمنظمات غير الحكومية</option>
                    <option value="International Organizations" {{ old('jobField') == 'International Organizations' ? 'selected' : '' }}>المنظمات الدولية</option>
                    <option value="Think Tanks & Policy Research" {{ old('jobField') == 'Think Tanks & Policy Research' ? 'selected' : '' }}>مراكز الأبحاث والسياسات</option>
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
                    <option value="صعدة" {{ old('location') == 'صعدة' ? 'selected' : '' }}>صعدة</option>
                    <option value="عمران" {{ old('location') == 'عمران' ? 'selected' : '' }}>عمران</option>
                    <option value="ريمة" {{ old('location') == 'ريمة' ? 'selected' : '' }}>ريمة</option>
                    <option value="البيضاء" {{ old('location') == 'البيضاء' ? 'selected' : '' }}>البيضاء</option>
                    <option value="الجوف" {{ old('location') == 'الجوف' ? 'selected' : '' }}>الجوف</option>
                    <option value="مأرب" {{ old('location') == 'مأرب' ? 'selected' : '' }}>مأرب</option>
                    <option value="شبوة" {{ old('location') == 'شبوة' ? 'selected' : '' }}>شبوة</option>
                    <option value="لحج" {{ old('location') == 'لحج' ? 'selected' : '' }}>لحج</option>
                    <option value="الضالع" {{ old('location') == 'الضالع' ? 'selected' : '' }}>الضالع</option>
                    <option value="المهرة" {{ old('location') == 'المهرة' ? 'selected' : '' }}>المهرة</option>
                    <option value="سقطرى" {{ old('location') == 'سقطرى' ? 'selected' : '' }}>سقطرى</option>
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
        <div class="footer-text">
            <a href="{{route('login')}}"> لدي حساب</a>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
        tinymce.init({
            selector: '#mission, #vision, #aboutus',
            menubar: false,
            plugins: 'lists link',
            toolbar: 'bold italic underline strikethrough | bullist numlist blockquote | link',
            setup: function (editor) {
                editor.on('change', function () {
                    tinymce.triggerSave();
                });
            }
        });

            const userType = document.getElementById('userType');
            const companyContainer = document.getElementById('company-container');
            const form = document.getElementById('registrationForm');


            const defaultAction = form.getAttribute('data-default-action');
            const companyAction = form.getAttribute('data-company-action');

            userType.addEventListener('change', function() {
                if (userType.value === 'company') {
                    companyContainer.style.display = 'block';

                    ["jobField", "location", "mission", "vision", "dateOfCreation", "aboutus", "logo", "phoneNumber", "website", "record"]
                    .forEach(function(id) {
                        let field = document.getElementById(id);
                        if (field) {
                            field.setAttribute('required', true);
                        }
                    });

                    form.setAttribute('action', companyAction);
                } else {
                    companyContainer.style.display = 'none';

                    ["jobField", "location", "mission", "vision", "dateOfCreation", "aboutus", "logo", "phoneNumber", "website", "record"]
                    .forEach(function(id) {
                        let field = document.getElementById(id);
                        if (field) {
                            field.removeAttribute('required');
                        }
                    });

                    form.setAttribute('action', defaultAction);
                }
            });
        });

    </script>


</body>
</html>
