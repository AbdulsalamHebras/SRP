<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ابحث عن وظيفة أحلامك</title>
    <link rel="stylesheet" href="{{asset('CSS/index-style.css')}}">
    <!-- Add Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

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

    <div class="container">
        <h1>ابحث عن وظيفة أحلامك</h1>
        <p>ابحث ضمن أكثر الوظائف الفعّالة على أكبر موقع للوظائف في اليمن</p>
        <div class="search-box">
            <input type="text" placeholder="ابحث عن الوظائف والمهارات">
            <button>بحث</button>
        </div>
        <div class="popular-searches">
            <span class="search-title">عمليات البحث الشائعة:</span>
            <div class="search-links">
                <a href="#" class="search-link">all works</a>
                <a href="#" class="search-link">management</a>
                <a href="#" class="search-link">IT</a>
                <a href="#" class="search-link">manager</a>
                <a href="#" class="search-link">director</a>
                <a href="#" class="search-link">عرض المزيد></a>
            </div>
        </div>
    </div>


<script>
    const navLinks = document.querySelectorAll('header div a');
    navLinks.forEach(link => {
        link.addEventListener('click', () => {
            // Remove the active class from all links
            navLinks.forEach(nav => nav.classList.remove('active'));

            // Add the active class to the clicked link
            link.classList.add('active');
        });
    });
    document.addEventListener('DOMContentLoaded', function () {
        const messageIcon = document.querySelector('.message-icon');
        const dropdownContent = document.querySelector('.message-dropdown-content');

        // فتح القائمة عند النقر على الأيقونة
        messageIcon.addEventListener('click', function (event) {
            event.stopPropagation(); // لمنع إغلاق القائمة عند النقر على الأيقونة
            dropdownContent.style.display =
                dropdownContent.style.display === 'block' ? 'none' : 'block';
        });

        // إغلاق القائمة عند النقر خارجها
        document.addEventListener('click', function () {
            dropdownContent.style.display = 'none';
        });
    });
</script>

</body>
</html>


