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
            <img src="https://via.placeholder.com/100" alt="Logo">
        </div>
        <!-- Form Fields -->
        <form method="POST" action="{{route('register')}}" enctype="multipart/form-data" id="registrationForm">
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
                class="form-control @error('email') is-invalid @enderror" name="email"
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
                class="form-control @error('password') is-invalid @enderror" name="password"
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

                <input type="text" name="jobField" placeholder="مجال العمل" id="jobField"
                class="form-control @error('jobField') is-invalid @enderror" value="{{ old('jobField') }}">
                @error('jobField')
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



            userType.addEventListener('change', function() {
                if (userType.value === 'company') {
                    companyContainer.style.display = 'block';

                    ["jobField", "mission", "vision", "dateOfCreation", "aboutus", "logo", "phoneNumber", "website", "record"].forEach(function(id) {
                        document.getElementById(id).setAttribute('required', true);
                    });

                    form.setAttribute('action', '{{ route('companies.register') }}');
                } else {
                    companyContainer.style.display = 'none';

                    ["jobField", "mission", "vision", "dateOfCreation", "aboutus", "logo", "phoneNumber", "website", "record"].forEach(function(id) {
                        document.getElementById(id).removeAttribute('required');
                    });

                    form.setAttribute('action', '{{ route('register') }}');
                }
            });
        });
    </script>


</body>
</html>
