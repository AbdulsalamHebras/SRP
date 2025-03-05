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
            <form method="GET" action="{{ route('jobs.index') }}">
                <label for="sort">الترتيب حسب:</label>
                <select id="sort" name="sort" onchange="this.form.submit()">
                    <option value="date" {{ request('sort', 'date') == 'date' ? 'selected' : '' }}>التاريخ</option>
                    <option value="type" {{ request('sort') == 'type' ? 'selected' : '' }}>نوع الوظيفة</option>
                    <option value="salary" {{ request('sort') == 'salary' ? 'selected' : '' }}>الراتب</option>
                </select>
            </form>
        </div>

        <div class="job-listing">
            @foreach ($jobs as $job)
                <div class="job-card">
                    <div class="favorite" onclick="event.stopPropagation();">
                        <i class="heart-icon" onclick="toggleFavorite(this)">&#9829;</i>
                    </div>
                    <a href="{{route('jobs.details',$job->id)}}" class="job-card-link">
                        <div class="job-info">
                            <h2 class="job-title">{{$job->jobName}}</h2>
                            <div class="company">
                                    <img src="{{ asset('storage/logos/' . $job->company->logo) }}" alt="Logo" class="logo">
                                    <span>{{ $job->company->name }}</span>
                            </div>
                            <span class="location">{{$job->location}}</span>
                            <p>{{$job->description}}</p>
                            <span class="salary">{{$job->currency}}{{$job->maxSalary}} - {{$job->currency}}{{$job->minSalary}}</span>
                            <span class="time-posted">
                                @if($job->updated_at > $job->created_at)
                                    {{ $job->updated_at->locale('ar')->diffForHumans() }}
                                @else
                                    {{ $job->created_at->locale('ar')->diffForHumans() }}
                                @endif
                            </span>
                        </div>
                    </a>
                    <div class="apply-btn" onclick="event.stopPropagation();">
                            <button onclick="window.location.href={{route('jobs.apply')}}";>التقديم السريع</button>
                    </div>
                </div>
            @endforeach
        </div>


    </div>
    @include('includes.footer')
    <script>
        function toggleFavorite(icon) {
            icon.style.color = icon.style.color === 'red' ? '#ccc' : 'red';
        }
    </script>
</body>
</html>
