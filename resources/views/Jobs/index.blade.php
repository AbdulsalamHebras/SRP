
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
    @if (session('success'))
    <div class="custom-alert success">
        {{ session('success') }}
        <span class="close-btn" onclick="this.parentElement.remove();">&times;</span>
    </div>
    @endif

    @if (session('error'))
        <div class="custom-alert error">
            {{ session('error') }}
            <span class="close-btn" onclick="this.parentElement.remove();">&times;</span>
        </div>
    @endif


    <div class="container">
            <h1>وظائف في اليمن</h1>
            <p>تم العثور على <span>{{$jobsNumber}} </span> وظيفة</p>

        <div class="filters">
            <form method="GET" action="{{ route('jobs.index') }}">
                <label for="sort">الترتيب حسب:</label>
                <select id="sort" name="sort" onchange="this.form.submit()">
                    <option value="similarity" {{ $sort == 'similarity' ? 'selected' : '' }}>التشابه</option>
                    <option value="date" {{ $sort == 'date' ? 'selected' : '' }}>التاريخ</option>
                    <option value="type" {{ $sort == 'type' ? 'selected' : '' }}>نوع الوظيفة</option>
                    <option value="salary" {{ $sort == 'salary' ? 'selected' : '' }}>الراتب</option>
                </select>
            </form>

        </div>

        @include('Jobs.getJobs')
    </div>
    @include('includes.footer')
    <script>
        

            function toggleFavorite(icon) {
                icon.style.color = icon.style.color === 'red' ? '#ccc' : 'red';
            }
            setTimeout(function() {
            document.querySelectorAll('.custom-alert').forEach(alert => {
                alert.style.opacity = "0";
                alert.style.transform = "translateY(-20px)";
                setTimeout(() => alert.remove(), 500);
            });
        }, 5000);
    </script>
</body>
</html>
