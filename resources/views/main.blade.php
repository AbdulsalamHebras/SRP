<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>لوحة التحكم</title>
    <link rel="stylesheet" href="{{asset('CSS/search.css')}}">
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
        <div class="container">
            <div class="header">
                <h1>وسام دريب</h1>
                <button class="button">عرض السيرة الذاتية</button>
            </div>
            <div class="section">
                <h2>تحديثات الوظائف</h2>
                <div class="box">
                    <div class="flex">
                        <p>ابحث عن وظائف الآن أو حدث ملفك الشخصي لبدء تلقي اقتراحات بالوظائف المناسبة.</p>
                        <button class="button">حدث ملفك الشخصي</button>
                    </div>
                </div>
            </div>
            <div class="section">
                <h2>طلباتي الوظيفية</h2>
                <div class="box">
                    <p>لم تتقدم إلى أي وظائف حتى الآن. ابحث عن الوظيفة وتقدم إليها في ثوانٍ!</p>
                    <button class="button">تصفح الوظائف</button>
                </div>
            </div>

            <div class="section">
                <h2>احصل على انتباه أصحاب العمل</h2>
                <div class="box">
                    <p>قم بتحديث أو تجديد سيرتك الذاتية بانتظام لتبقى في مقدمة نتائج بحث أصحاب العمل.</p>
                    <p class="email">آخر تحديث: Dec 19, 2024</p>
                    <button class="button">حدث السيرة الذاتية</button>
                </div>
            </div>
        </div>
    </main>
    @include('includes.footer')
</body>
</html>
