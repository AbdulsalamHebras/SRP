<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ابحث عن وظيفة أحلامك</title>
   <link rel="stylesheet" href="{{asset('CSS/index-style.css')}}">
    
</head>
<body>

<header>
    <div>
        <a href="#" id="srp-link" class="active">SRP</a>
        <a href="#" class="nav-link">الرئيسية</a>
        <a href="#" class="nav-link">البحث عن وظائف</a>
        <a href="#" class="nav-link">خدمات السيرة الذاتية</a>
        <a href="#" class="nav-link">المدونة</a>
    </div>
    <div>
        <a href="{{route('login')}}" class="nav-link">تسجيل</a>
        <a href="{{route('register')}}" class="nav-link">دخول</a>
    </div>
</header>

<div class="container">
    <h1>ابحث عن وظيفة أحلامك</h1>
    <p>ابحث ضمن أكثر الوظائف الفعّالة على أكبر موقع للوظائف في اليمن </p>
    <div class="search-box">
        <input type="text" placeholder="ابحث عن الوظائف والمهارات" />
        <button>ابحث</button>
    </div>
    <div class="popular-searches">
        <span>عمليات البحث الشائعة:</span>
        <a href="#">director</a>
        <a href="#">manager</a>
        <a href="#">it</a>
        <a href="#">management</a>
        <a href="#">all works</a>
        <a href="#">عرض المزيد</a>
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
</script>

</body>
</html>
