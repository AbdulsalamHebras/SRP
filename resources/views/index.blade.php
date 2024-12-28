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
    @include('header')
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
    <div class="section-title">من هي الشركات التي توظف على طموح؟</div>
    <div class="companies-container">
        <div class="company-logo"><img src="https://via.placeholder.com/120" alt="شركة 1"></div>
        <div class="company-logo"><img src="https://via.placeholder.com/120" alt="شركة 2"></div>
        <div class="company-logo"><img src="https://via.placeholder.com/120" alt="شركة 3"></div>
        <div class="company-logo"><img src="https://via.placeholder.com/120" alt="شركة 4"></div>
        <div class="company-logo"><img src="https://via.placeholder.com/120" alt="شركة 5"></div>
        <div class="company-logo"><img src="https://via.placeholder.com/120" alt="شركة 6"></div>
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


