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
    @include('search')
    <div class="container">
        <h2 class="title">الشركات المختارة</h2>
        <div class="companies">
           @foreach ($companies as $company)
                <div class="company-card">
                    <div class="company-info">
                        <div class="company-logo">
                            <img src="{{asset('storage/logos/'.$company->logo)}}" alt="شعار الشركة">
                        </div>
                        <div class="company-details">
                            <h3 class="company-name"><a href="{{route('companies.details',$company->id)}}">{{$company->name}}</a></h3>
                            <p class="company-field">{{$company->jobField}} </p>
                            <p class="company-location"> {{$company->location}} </p>
                            <a href="#" class="follow-btn">متابعة</a>
                        </div>
                    </div>
                </div>
           @endforeach

        </div>
    </div>

    @include('includes.footer')

</body>
</html>
