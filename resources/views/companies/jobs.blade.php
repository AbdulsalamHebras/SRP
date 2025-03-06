<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('CSS/jobs/index.css')}}">
    <title>الوظائف</title>
</head>
<body>
    @include('includes.header')
    @include('search')
    <div class="container">
            <h1>وظائف في اليمن</h1>
            <p>تم العثور على <span>{{$jobsNumber}} </span> وظيفة</p>

        <div class="filters">
            <form method="GET" action="{{ route('company.jobs',auth()->guard('company')->user()->id ) }}">
                <label for="sort">الترتيب حسب:</label>
                <select id="sort" name="sort" onchange="this.form.submit()">
                    <option value="date" {{ $sort == 'date' ? 'selected' : '' }}>التاريخ</option>
                    <option value="type" {{ $sort == 'type' ? 'selected' : '' }}>نوع الوظيفة</option>
                    <option value="maxsalary" {{ $sort == 'maxsalary' ? 'selected' : '' }}>الراتب</option>
                </select>
            </form>
        </div>
        <div class="add-btn-container">
            <a href="{{route('jobs.add')}}" class="add-btn">إضافة عمل</a>
        </div>


       @include('Jobs.getJobs')


    </div>
    @include('includes.footer')
    <script>
        function toggleFavorite(icon) {
            icon.style.color = icon.style.color === 'red' ? '#ccc' : 'red';
        }
    </script>
</body>
</html>
