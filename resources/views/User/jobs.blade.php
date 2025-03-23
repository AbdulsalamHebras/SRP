<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('CSS/jobs/index.css')}}">
    <title>{{$applier->name}} appliments </title>
    
</head>
<body>
    @include('includes.header')
    <div class="job-listing">
            @foreach ($jobs as $job)
                <div class="job-card">
                    @if (!auth()->guard('company')->user())
                        <div class="favorite" onclick="event.stopPropagation();">
                            <i class="heart-icon" onclick="toggleFavorite(this)">&#9829;</i>
                        </div>
                    @endif
                    <a href="{{route('jobs.details',$job->id)}}" class="job-card-link">
                        <div class="job-info">
                            <h2 class="job-title">{{$job->jobName}}</h2>
                            <div class="company">
                                    <img src="{{ asset('storage/logos/' . $job->company->logo) }}" alt="Logo" class="logo">
                                    <span>{{ $job->company->name }}</span>
                            </div>
                            <span class="location">{{$job->location}}</span>
                            <p>{!!$job->description !!}</p>
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


                </div>
            @endforeach

    </div>

    @include('includes.footer')
    <script>
        function toggleFavorite(icon) {
            icon.style.color = icon.style.color === 'red' ? '#ccc' : 'red';
        }
    </script>
</body>
</html>
