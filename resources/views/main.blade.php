<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>لوحة التحكم</title>
    <link rel="stylesheet" href="{{asset('CSS/main.css')}}">
    <style>
        .search-box {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        .search-box input, .search-box button {
            padding: 10px;
            font-size: 1em;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-top: 20px
        }

        .search-box button {
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
        }

        .search-box button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    @include('includes.header')
    <div class="search-box">
        <input type="text" placeholder="ابحث عن الوظائف والمهارات">
        <button>بحث</button>
    </div>
    <main>
        <section class="profile-section">
            <div class="profile-card">
                <img src="placeholder-profile.png" alt="صورة شخصية">
                <h2>سلام</h2>
                <p>رقم الهاتف: <a href="#">أضف رقم الهاتف</a></p>
                <p>البريد الإلكتروني: <a href="mailto:salamhebras@gmail.com">salamhebras@gmail.com</a></p>
                <button>عرض السيرة الذاتية</button>
            </div>
            <div class="update-notice">
                <h3>احصل على انتباه أصحاب العمل</h3>
                <p>
                    قم بتحديث أو تجديد سيرتك الذاتية بانتظام لتبقى في مقدمة نتائج بحث أصحاب العمل.
                </p>
                <p>آخر تحديث: Dec 20, 2024</p>
                <button>حدث السيرة الذاتية</button>
            </div>
        </section>
        <section class="progress-section">
            <h2>حسن سيرتك الذاتية</h2>
            <div class="progress-bar">
                <div class="progress" style="width: 23%;">قوة ملفك الشخصي: 23%</div>
            </div>
            <button>أضف الوظيفة المرغوبة</button>
        </section>
        <section class="jobs-section">
            <h2>تحديثات الوظائف</h2>
            <p>ابحث عن وظائف الآن أو حدث ملفك الشخصي لبدء تلقي اقتراحات بالوظائف المناسبة.</p>
        </section>
    </main>
    @include('includes.footer')
</body>
</html>
