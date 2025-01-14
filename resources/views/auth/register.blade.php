<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="{{asset('CSS/login.css')}}">

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

            <div id="record-container">
                <label for="record">ارفق صورة للسجل التجاري</label>
                <input type="file" name="record" id="record">
            </div>
            @error('record')
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

            <button type="submit" class="btn">إنشاء</button>
        </form>
        <div class="footer-text">
            <a href="{{route('login')}}"> لدي حساب</a>
        </div>
    </div>

    <script>
        const userType = document.getElementById('userType');
        const recordContainer = document.getElementById('record-container');
        const form = document.getElementById('registrationForm');

        userType.addEventListener('change', function() {
            if (userType.value === 'company') {
                recordContainer.style.display = 'block';
                document.getElementById('record').setAttribute('required', true);
                form.setAttribute('action', '{{ route('company.register') }}');
            } else {
                recordContainer.style.display = 'none';
                document.getElementById('record').removeAttribute('required');
                form.setAttribute('action', '{{ route('register') }}');
            }
        });
    </script>
</body>
</html>
