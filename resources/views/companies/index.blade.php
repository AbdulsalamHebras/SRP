<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('CSS/companies/index.css')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>الشركات</title>
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
                            <form action="{{ route('companies.follow', $company->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="follow-btn">
                                    {{ auth()->check() && $company->isFollowedBy(auth()->user()) ? 'إلغاء المتابعة' : 'متابعة' }}
                                </button>
                            </form>


                        </div>
                    </div>
                </div>
           @endforeach

        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            document.querySelectorAll('.follow-btn').forEach(button => {
                button.addEventListener('click', function () {
                    let companyId = this.getAttribute('data-company-id');

                    fetch(`/companies.follow/${companyId}`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({})
                    })
                    .then(response => response.json())
                    .then(data => {
                        console.log('Server Response:', data); // Debugging
                        if (data.status === 'followed') {
                            this.innerText = "إلغاء المتابعة";
                        } else {
                            this.innerText = "متابعة";
                        }
                    })
                    .catch(error => console.error('Fetch Error:', error)); // Debugging
                });
            });
        });

    </script>
    @include('includes.footer')

</body>
</html>
