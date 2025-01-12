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
        <form method="POST" action="{{route('register')}}" enctype="multipart/form-data">
            @csrf
            <input type="text" name="name" placeholder="اسم المستخدم" id="name" required>
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            <input type="text" name="email" placeholder="البريد الإلكتروني" id="email" required>
            @error('email')
                <span class="invalid-feedba
                ck" role="alert">
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

            <input type="password" name="password" placeholder="كلمة المرور" id="password" required>
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            <input type="password" name="password_confirmation" placeholder="تأكيد كلمة المرور" id="password_confirmation" required>
            @error('password_confirmation')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            <button type="submit" class="btn">إنشاء</button>
        </form>

    </div>

    <script>
        const userType = document.getElementById('userType');
        const recordContainer = document.getElementById('record-container');

        userType.addEventListener('change', function() {
            if (userType.value === 'company') {
                recordContainer.style.display = 'block';
                document.getElementById('record').setAttribute('required', true);
            } else {
                recordContainer.style.display = 'none';
                document.getElementById('record').removeAttribute('required');
            }
        });
    </script>
</body>
</html>
