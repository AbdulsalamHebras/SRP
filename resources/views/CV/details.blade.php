<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('CSS/CV/details.css')}}">
    <title> {{$applier->name}} CV </title>
</head>
<body>
    @include('includes.header')
    <div class="container">
        <div class="applier-profile">
            <div class="photo-section">
                <img src="{{ asset('storage/' . $applier->photo) }}" alt="Applier Photo">
            </div>
            <div class="info-section">
                <h2>{{ $applier->name }}</h2>
                <p><strong>البريد الاكتروني:</strong> {{ $applier->email }}</p>
                <p><strong>رقم التلفون:</strong> {{ $applier->phoneNumber ?? 'N/A' }}</p>
                <p><strong>المدينة:</strong> {{ $applier->city ?? 'N/A' }}</p>
                <p><strong>عنوان السكن:</strong> {{ $applier->address ?? 'N/A' }}</p>
                <p><strong>الجنس:</strong> {{ $applier->gender ?? 'N/A' }}</p>
                <p><strong>التخصص:</strong> {{ $applier->acadmicStudy ?? 'N/A' }}</p>
                <p><strong>اللغات:</strong> {{ $applier->languages ?? 'N/A' }}</p>
                <p><strong>تاريخ التخرج:</strong> {{ $applier->graduationDate ?? 'N/A' }}</p>
                <p><strong>العمر:</strong> {{ $applier->age ?? 'N/A' }}</p>
                <p>
                    <strong>السيرة الذاتية:</strong>
                    @if($applier->CVfile)
                        <a href="{{ asset('storage/' . $applier->CVfile) }}" target="_blank" class="cv-button">Download CV</a>
                    @else
                        لم يتم رفع السيرة الذاتية
                    @endif
                </p>
                <button>تحديث</button>
            </div>
        </div>
    </div>

    @include('includes.footer')
</body>
</html>
