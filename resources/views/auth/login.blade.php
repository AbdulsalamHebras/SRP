<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="{{asset('CSS/login.css')}}">
</head>
<body>
    <div class="login-container">
        <!-- Logo -->
        <div class="logo">
            <img src="https://via.placeholder.com/100" alt="Logo">
        </div>

        <!-- Form Fields -->
        <form id="loginForm" action="{{route('login')}}" method="POST">
            @csrf
            <input type="text" name="email" placeholder=" البريد الاكتروني" id="email"
                class="form-control form-control-lg @error('email') is-invalid @enderror" value="{{ old('username') }}"
                required autocomplete="email" autofocus>>
            <input type="password" name="password" placeholder="كلمة المرور" id="password"
                class="form-control form-control-lg @error('password') is-invalid @enderror" name="password"
                required autocomplete="current-password">
            <select id="userType" name="accountType" required>
                <option value="">نوع المستخدم</option>
                <option value="applier">باحث عن عمل</option>
                <option value="company">شركة</option>
            </select>
            <button type="submit" class="btn">دخول</button>
        </form>

        <!-- Footer Links -->
        <div class="footer-text">
            <a href="{{route('register')}}">ليس لدي حساب، إنشاء حساب</a>
        </div>
    </div>


</body>
</html>
