<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Header</title>
</head>
<body>
    <header>
        <div class="header-container">
            <div class="logo">
                <h1>ط<span>موح</span></h1>
            </div>
            <div class="nav-links">
                <a href="{{route('main')}}" class="nav-link">الرئيسية</a>
                <a href="" class="nav-link">البحث عن وظائف</a>
                <a href="#" class="nav-link"> الشركات </a>
                <a href="#" class="nav-link">طلبات التوظيف</a>
                <a href="#" class="nav-link">من شاهد سيرتي؟</a>
            </div>
            <div class="message-dropdown">
                <div class="message-icon">
                    <i class="fa fa-envelope"></i>
                    <div class="notification-badge">3</div>
                </div>
                <div class="message-dropdown-content">
                    <h4>الرسائل الجديدة</h4>
                    <p>لديك رسائل غير مقروءة.</p>
                    <a href="#">عرض الكل</a>
                </div>
            </div>
            <div class="auth-links">
                <a href="{{ route('login') }}" class="nav-link">تسجيل الدخول</a>
                <a href="{{ route('register') }}" class="nav-link">إنشاء حساب</a>
            </div>
        </div>
    </header>

</body>
</html>
