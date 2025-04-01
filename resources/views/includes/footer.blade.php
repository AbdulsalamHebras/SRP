<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('CSS/includes/footer.css')}}">
    <title>Footer</title>
</head>
<body>
    <footer class="footer">
        <div class="footer-container">
            <div class="footer-jobs">
                <h3>ابحث عن وظائف</h3>
                <div class="job-grid">
                    <ul>
                        <li><a href="{{ route('jobs.search', ['location' => 'صنعاء']) }}">وظائف في صنعاء</a></li>
                        <li><a href="{{ route('jobs.search', ['location' => 'عدن']) }}">وظائف في عدن</a></li>
                        <li><a href="{{ route('jobs.search', ['location' => 'تعز']) }}">وظائف في تعز</a></li>
                        <li><a href="{{ route('jobs.search', ['location' => 'مارب']) }}">وظائف في مأرب</a></li>
                    </ul>
                    <ul>
                        <li><a href="{{ route('jobs.search', ['location' => 'الحديدة']) }}">وظائف في الحديدة</a></li>
                        <li><a href="{{ route('jobs.search', ['location' => 'إب']) }}">وظائف في إب</a></li>
                        <li><a href="{{ route('jobs.search', ['location' => 'ذمار']) }}">وظائف في ذمار</a></li>
                        <li><a href="{{ route('jobs.search', ['location' => 'الجوف']) }}">وظائف في الجوف</a></li>
                    </ul>
                    <ul>
                        <li><a href="{{ route('jobs.search', ['location' => 'صعدة']) }}">وظائف في صعدة</a></li>
                        <li><a href="{{ route('jobs.search', ['location' => 'حجة']) }}">وظائف في حجة</a></li>
                        <li><a href="{{ route('jobs.search', ['location' => 'المحويت']) }}">وظائف في المحويت</a></li>
                        <li><a href="{{ route('jobs.search', ['location' => 'ريمة']) }}">وظائف في ريمة</a></li>
                    </ul>
                    <ul>
                        <li><a href="{{ route('jobs.search', ['location' => 'عمران']) }}">وظائف في عمران</a></li>
                        <li><a href="{{ route('jobs.search', ['location' => 'شبوة']) }}">وظائف في شبوة</a></li>
                        <li><a href="{{ route('jobs.search', ['location' => 'المهرة']) }}">وظائف في المهرة</a></li>
                        <li><a href="{{ route('jobs.search', ['location' => 'حضرموت']) }}">وظائف في حضرموت</a></li>
                    </ul>
                    <ul>
                        <li><a href="{{ route('jobs.search', ['location' => 'لحج']) }}">وظائف في لحج</a></li>
                        <li><a href="{{ route('jobs.search', ['location' => 'أبين']) }}">وظائف في أبين</a></li>
                        <li><a href="{{ route('jobs.search', ['location' => 'سقطرى']) }}">وظائف في سقطرى</a></li>
                        <li><a href="{{ route('jobs.search', ['location' => 'عن بعد']) }}">وظائف عن بعد</a></li>
                    </ul>
                </div>
            </div>

            <div class="info-sections">
                <div class="footer-section about-section">
                    <h3>نبذة عن طموح.كوم</h3>
                    <p>طموح.كوم هو أكبر موقع للوظائف في اليمن.</p>
                    <p>ما يميزنا أننا نستخدم الذكاء الاصطناعي في تحليل الأعمال.</p>
                    <p>نحن صلة الوصل بين الباحثين عن عمل وأصحاب العمل.</p>
                    <p>كل يوم، يقوم أهم أصحاب العمل بإضافة آلاف الوظائف الشاغرة.</p>
                </div>
                <div class="footer-section company-section">
                    <h3>شركتنا</h3>
                    <ul>
                        <li><a href="#">حول طموح.كوم</a></li>
                        <li><a href="#">اتصل بنا</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="footer-social">
            <h3>تابعنا على مواقع التواصل الاجتماعي</h3>
            <div class="social-icons">
                <a href="#"><img src="{{asset('images/Media/facebook.png')}}" alt="Facebook"></a>
                <a href="#"><img src="{{asset('images/Media/X.png')}}" alt="Twitter"></a>
                <a href="#"><img src="{{asset('images/Media/linkedin.png')}}" alt="LinkedIn"></a>
                <a href="#"><img src="{{asset('images/Media/insta.jfif')}}" alt="Insta"></a>
            </div>
        </div>

        <div class="footer-bottom">
            <p>سياسة الخصوصية | شروط الاستخدام | إعدادات ملفات تعريف الارتباط</p>
        </div>
    </footer>
</body>
</html>
