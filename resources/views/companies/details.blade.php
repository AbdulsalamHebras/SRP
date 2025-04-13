<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('CSS/companies/details.css')}}">
    <link rel="stylesheet" href="{{asset('CSS/jobs/index.css')}}">

    <title>{{$company->name}}</title>
</head>
<body>
    @include('includes.header')
    <div class="company-details">
        <div class="logo">
            <img src="{{asset('storage/logos/'.$company->logo)}}" alt="شعار الشركة">
        </div>

        <h2 class="company-name">{{ $company->name }}</h2>
        <p class="job-field"><strong>مجال العمل:</strong> {{ $company->jobField }}</p>
        <p class="location"><strong>الموقع:</strong> {{ $company->location }}</p>
        <p class="date-created"><strong>تاريخ الإنشاء:</strong> {{ $company->dateOfCreation }}</p>
        <p class="jobs-number"><strong>عدد الوظائف المتاحة:</strong> {{ $company->jobsNumber }}</p>

        <div class="contact-info">
            <p><strong>البريد الإلكتروني:</strong> <a href="mailto:{{ $company->email }}">{{ $company->email }}</a></p>
            <p><strong>الهاتف:</strong> <a href="tel:{{ $company->phoneNumber }}" dir="ltr">{{ $company->phoneNumber }}</a></p>
            <p><strong>الموقع الإلكتروني:</strong> <a href="{{ $company->website }}" target="_blank">{{ $company->website }}</a></p>
        </div>


        <div class="company-mission">
            <h3>مهمتنا</h3>
            <div>{!! $company->mission !!}</div>
        </div>

        <div class="company-vision">
            <h3>رؤيتنا</h3>
            <div>{!! $company->vision !!}</div>
        </div>

        <div class="company-aboutus" >
            <h3>من نحن</h3>
            <div >{!! $company->aboutus !!}</div>
        </div>
    </div>
    @if (Auth::guard('company')->check())
        <div class="edit-btn-container">
            <form action="{{route('company.edit',$company->id)}}" enctype="multipart/form-data" method="GET" >
                @csrf
                <button class="edit-btn">تعديل</button>
            </form>
        </div>
    @endif
    @if (!Auth::guard('company')->check())
        <div class="job-listing">
            @foreach ($company->jobs  as $job)
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
    @endif



    @include('includes.footer')
    <script>
        function toggleFavorite(icon) {
            icon.style.color = icon.style.color === 'red' ? '#ccc' : 'red';
        }
    </script>
</body>
</html>
