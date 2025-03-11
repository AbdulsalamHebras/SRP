<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>لوحة التحكم</title>
    <link rel="stylesheet" href="{{asset('CSS/main/index.css')}}">
    <style>
        .search-box {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
            margin-top: 20px

        }

        .search-box input, .search-box button {
            padding: 10px;
            font-size: 1em;
            border: 1px solid #ccc;
            bord
            er-radius: 5px;
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
                <h1>{{$applier->name}}</h1>

                <a href="{{route('user.seeCV')}}">
                    <button class="button">عرض الملف الشخصي</button>
                </a>
            </div>
            <div class="section">
                <h2>تحديثات الوظائف</h2>
                <div class="box">
                    <div class="flex">
                        <p> حدث ملفك الشخصي او قم باكماله لبدء تلقي اقتراحات بالوظائف المناسبة.</p>
                        <a href="{{route('user.updateCV')}}">
                            <button class="button">حدث ملفك الشخصي</button>
                        </a>
                    </div>
                </div>
            </div>

            <div class="section">
                <h2>طلباتي الوظيفية</h2>
                <div class="box">
                    <p>لديك في الموقع <span>{{$appliedJobs}} </span> طلب توظيف</p>
                    <a href="{{ route('user.appliments') }}">
                        <button class="button">تصفح الوظائف</button>
                    </a>
                </div>
            </div>


        </div>
    </main>
    @include('includes.footer')
</body>
</html>
