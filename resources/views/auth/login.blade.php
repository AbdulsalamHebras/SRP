<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="{{asset('CSS/includes/header.css')}}">
    <link rel="stylesheet" href="{{asset('CSS/auth/login.css')}}">
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
        <form id="loginForm" action="{{ route('login') }}" method="POST">
            @csrf
            <!-- Email Field -->
            <input type="text" name="email" placeholder=" البريد الإلكتروني" id="email"
                class="form-control form-control-lg @error('email') is-invalid @enderror"
                value="{{ old('email') }}" required autocomplete="email" autofocus>
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            <!-- Password Field -->
<div style="position: relative;">
    <input type="password" name="password" placeholder="كلمة المرور" id="password"
        class="form-control form-control-lg @error('password') is-invalid @enderror"
        required autocomplete="current-password"
        style="padding-left: 40px;"> <!-- مساحة للأيقونة عاليسار -->

    <!-- Eye Icon -->
    <span onclick="togglePassword()" id="toggleIcon"
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

<script>
    function togglePassword() {
        const passwordInput = document.getElementById("password");
        const toggleIcon = document.getElementById("toggleIcon");

        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            toggleIcon.textContent = "🙈";
        } else {
            passwordInput.type = "password";
            toggleIcon.textContent = "👁️";
        }
    }
</script>


            <!-- Account Type Field -->
            <select id="userType" name="accountType" required>
                <option value="">نوع المستخدم</option>
                <option value="applier" {{ old('accountType') == 'applier' ? 'selected' : '' }}>باحث عن عمل</option>
                <option value="company" {{ old('accountType') == 'company' ? 'selected' : '' }}>شركة</option>
            </select>
            @error('accountType')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            <!-- Submit Button -->
            <button type="submit" class="btn">دخول</button>
        </form>

        <!-- Footer Links -->
        <div class="footer-text">
            <a href="{{ route('register') }}">ليس لدي حساب، إنشاء حساب</a>
        </div>
    </div>
</body>
</html>
