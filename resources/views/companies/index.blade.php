<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('CSS/companies/index.css')}}">
    <title>Companies</title>
</head>
<body>
    @include('includes.header')
    <div class="container">
        <h2 class="title">الشركات المختارة</h2>
        <div class="companies">
            @foreach ($companies as $company)
                <div class="company-card">
                    <img src="{{asset('images/'.$company->logo)}}" alt="Company Logo" class="company-logo">
                    <a href="#" class="company-name">{{$company->name}}</a>
                    <p class="industry">{{$company->jobField}}</p>
                    <p class="location">{{$company->location}}</p>
                    <a href="#" class="follow-btn">متابعة</a>
                </div>
            @endforeach
        </div>
    </div>

    @include('includes.footer')
</body>
</html>
