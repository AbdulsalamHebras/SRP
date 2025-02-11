<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('CSS/jobs/index.css')}}">
    <link rel="stylesheet" href="{{asset('CSS/search.css')}}">
    <title>Jobs</title>
</head>
<body>
    @include('includes.header')
    <div class="search-box">
        <input type="text" placeholder="ابحث عن الوظائف والشركات">
        <div class="dropdown">
            <input class="dropdown-toggle" onclick="toggleDropdown()" id="locationInput" placeholder="جميع المواقع">
            <div class="dropdown-menu" id="dropdownMenu">
                <input type="text" class="dropdown-search" placeholder="بحث..." oninput="filterDropdown(this)">
                <ul class="dropdown-list">
                    <li onclick="selectLocation(this)">جميع المواقع</li>
                    <li onclick="selectLocation(this)">صنعاء</li>
                    <li onclick="selectLocation(this)">عدن</li>
                    <li onclick="selectLocation(this)">تعز</li>
                    <li onclick="s electLocation(this)">مارب</li>
                    <li onclick="selectLocation(this)">الضالع</li>
                    <li onclick="selectLocation(this)">الحديدة</li>
                </ul>
            </div>
        </div>
        <button>بحث</button>
    </div>
    <div class="container">
            <h1>وظائف في اليمن</h1>
            <p>تم العثور على <span>43.1K</span> وظيفة</p>

        <div class="filters">
            <label for="sort">الترتيب حسب:</label>
            <select id="sort">
                <option value="language">التاريخ</option>
                <option value="language">نوع الوظيفة</option>
                <option value="language">الراتب</option>
            </select>
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
                                    <img src="{{ asset('images/logos/' . $job->company->logo) }}" alt="Logo" class="logo">
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
        function toggleDropdown() {
            const menu = document.getElementById('dropdownMenu');
            menu.classList.toggle('active');
        }

        function filterDropdown(input) {
            const filter = input.value.toLowerCase();
            const items = document.querySelectorAll('.dropdown-list li');

            items.forEach(item => {
                const text = item.textContent.toLowerCase();
                item.style.display = text.includes(filter) ? '' : 'none';
            });
        }

        document.addEventListener('click', (e) => {
            const dropdown = document.querySelector('.dropdown');
            if (!dropdown.contains(e.target)) {
                document.getElementById('dropdownMenu').classList.remove('active');
            }
        });

        function selectLocation(item) {
            const input = document.getElementById("locationInput");
            const dropdown = document.getElementById("dropdownMenu");

            input.value = item.innerText;

            dropdown.style.display = "none";
        }
    </script>
</body>
</html>
