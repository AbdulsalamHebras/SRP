<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ابحث عن وظيفة أحلامك</title>
    <link rel="stylesheet" href="{{asset('CSS/index.css')}}">
    <link rel="stylesheet" href="{{asset('CSS/jobs/index.css')}}">

    <!-- Add Font Awesome for Icons -->
</head>
<body>
    @include('includes/header')
    <div class="container">
        <h1>ابحث عن وظيفة أحلامك</h1>
        <p>ابحث ضمن أكثر الوظائف الفعّالة على أكبر موقع للوظائف في اليمن</p>
        <div class="search-box">
            <input type="text" placeholder="ابحث عن الوظائف والمهارات">
            <button>بحث</button>
        </div>
        <div class="popular-searches">
            <span class="search-title">عمليات البحث الشائعة:</span>
            <div class="search-links">
                <a href="#" class="search-link">all works</a>
                <a href="#" class="search-link">management</a>
                <a href="#" class="search-link">IT</a>
                <a href="#" class="search-link">manager</a>
                <a href="#" class="search-link">director</a>
                <a href="{{route('jobs.index')}}" class="search-link">عرض المزيد></a>
            </div>
        </div>
    </div>

    <div class="section-title">أحدث الوظائف</div>
    <div class="job-listing">
        @foreach ($jobs as $job)
            <div class="job-card">
                <div class="favorite" onclick="event.stopPropagation();">
                    <i class="heart-icon">&#9829;</i>
                </div>
                <a href="{{route('jobs.details',$job->id)}}" class="job-card-link">
                    <div class="job-info">
                        <h2 class="job-title">{{$job->jobName}}</h2>
                        <div class="company">
                                <img src="{{ asset('storage/logos/' . $job->company->logo) }}" alt="Logo" class="logo">
                                <span>{{ $job->company->name }}</span>
                        </div>
                        <span class="location">{{$job->location}}</span>
                        <p>{!!$job->description!!}</p>
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
    <div class="show-more-container">
        <a href="{{route('jobs.index')}}" class="show-more-btn" id="show-more-btn">عرض المزيد</a>
    </div>

    @include('includes.footer')

    <script>


        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll(".heart-icon").forEach(icon => {
            icon.addEventListener("click", function() {
                this.style.color = this.style.color === "red" ? "#ccc" : "red";
                    });
                });
            const navLinks = document.querySelectorAll('header div a');
            navLinks.forEach(link => {
                link.addEventListener('click', () => {
                    navLinks.forEach(nav => nav.classList.remove('active'));

                    link.classList.add('active');
                });
            });
            const messageIcon = document.querySelector('.message-icon');
            const dropdownContent = document.querySelector('.message-dropdown-content');

            messageIcon.addEventListener('click', function (event) {
                event.stopPropagation();
                dropdownContent.style.display =
                    dropdownContent.style.display === 'block' ? 'none' : 'block';
            });

            document.addEventListener('click', function () {
                dropdownContent.style.display = 'none';
            });
        });

    </script>
</body>
</html>


