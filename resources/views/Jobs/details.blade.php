
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> {{$job->jobName}} </title>
<link rel="stylesheet" href="{{asset('CSS/jobs/details.css')}}">
</head>
<body class="job-page">
    @include('includes.header')
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


    <div class="job-header">
        <h2 class="job-title">{{$job->jobName}}</h2>
        <div class="company">
            <img src="{{ asset('storage/logos/' . $job->company->logo) }}" alt="Logo" class="logo">
            <span>{{ $job->company->name }}</span>
        </div>
        <div class="job-details">
            <p class="location">{{$job->location}}</p>
            <p class="time">
                @if($job->updated_at > $job->created_at)
                    {{ $job->updated_at->locale('ar')->diffForHumans() }}
                @else
                    {{ $job->created_at->locale('ar')->diffForHumans() }}
                @endif
            </p>
            <p class="job-type">نوع الوظيفة: {{ $job->jobType }}</p>
            <p class="salary">الحد الأدنى للراتب: {{ $job->minSalary }} {{$job->currency}} | الحد الأقصى للراتب: {{$job->currency}} {{ $job->maxSalary }} | عدد المقدمين في الوظيفة: {{$job->reqGrade}} </p>
        </div>
        <p>اخر موعد للتقديم: {{$job->expirationDate}} </p>
        @if (!auth()->guard('company')->user())
                <form action="{{ route('jobs.apply') }}" method="POST">
                    @csrf
                    <input type="hidden" name="job_id" value="{{ $job->id }}">
                    <button type="submit" class="apply-btn">تقديم</button>
                </form>
        @endif
    </div>

    <div class="content">

        <h3 class="section-title">الوصف الوظيفي</h3>
        <p class="job-description">
            {!!$job->description!!}
        </p>
        <h3 class="section-title"> مطلبات الوظيفة</h3>
        <p class="job-description">
            {!!$job->requirements!!}
        </p>
    </div>
    @include('includes.footer')
    <script>
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
