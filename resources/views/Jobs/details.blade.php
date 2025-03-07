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
            <p class="salary">الحد الأدنى للراتب: {{ $job->minSalary }} {{$job->currency}} | الحد الأقصى للراتب: {{$job->currency}} {{ $job->maxSalary }} </p>
        </div>
        <p>اخر موعد للتقديم: {{$job->expirationDate}} </p>
        @if (!auth()->guard('company')->user())
            <a href="#" class="apply-btn">التقديم على موقع الشركة</a>
        @endif
    </div>

    <div class="content">
        <div class="notification">
            <label class="switch">
                <input type="checkbox">
                <span class="slider round"></span>
            </label>
        </div>
        <h3 class="section-title">الوصف الوظيفي</h3>
        <p class="job-description">
            {{$job->description}}
        </p>
        <h3 class="section-title"> مطلبات الوظيفة</h3>
        <p class="job-description">
            {{$job->requirements}}
        </p>
    </div>
    @include('includes.footer')
</body>
</html>
