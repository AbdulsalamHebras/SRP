<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="{{asset('tinymce/js/tinymce/tinymce.min.js')}}"></script>
    <link rel="stylesheet" href="{{asset('CSS/companies/edit.css')}}">
    <title> تعديل بيانات {{$company->name}}</title>
</head>
<body>
    @include('includes.header')
    <div class="form-container">
        <form method="POST" enctype="multipart/form-data" action>
            @csrf
            @method('PUT')
            <label for="name">أسم الشركة</label>
            <input type="text" name="name" placeholder="اسم الشركة" id="name"
                class="form-control @error('name') is-invalid @enderror" value="{{ $company->name }}" required>
            @error('name') <span class="invalid-feedback"><strong>{{ $message }}</strong></span> @enderror
            <label for="email">البريد الإلكتروني</label>
            <input type="email" name="email" placeholder="البريد الإلكتروني" id="email"
                class="form-control @error('email') is-invalid @enderror" value="{{ $company->email }}" required>
            @error('email') <span class="invalid-feedback"><strong>{{ $message }}</strong></span> @enderror
            <label for="password">كلمة المرور الجديدة (اختياري)</label>
            <input type="password" name="password" placeholder="كلمة المرور" id="password" class="form-control @error('password') is-invalid @enderror">
            @error('password')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror

            <label for="password_confirmation">تأكيد كلمة المرور</label>
            <input type="password" name="password_confirmation" placeholder="تأكيد كلمة المرور" id="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror">
            @error('password_confirmation')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
            <label for="phoneNumber">رقم التلفون</label>
            <input type="text" name="phoneNumber" placeholder="رقم الهاتف" id="phoneNumber"
                class="form-control @error('phoneNumber') is-invalid @enderror" value="{{ $company->phoneNumber }}">
            @error('phoneNumber') <span class="invalid-feedback"><strong>{{ $message }}</strong></span> @enderror
            <label for="website">الموقع الإلكتروني</label>
            <input type="url" name="website" placeholder="الموقع الإلكتروني" id="website"
                class="form-control @error('website') is-invalid @enderror" value="{{ $company->website }}">
            @error('website') <span class="invalid-feedback"><strong>{{ $message }}</strong></span> @enderror

            <label for="jobField">مجال العمل</label>
            <select name="jobField" id="jobField" class="form-control @error('jobField') is-invalid @enderror">
                <option value="" disabled>اختر مجال العمل</option>
                <option value="IT" {{ $company->jobField == 'IT' ? 'selected' : '' }}>تكنولوجيا المعلومات</option>
                <option value="Finance" {{ $company->jobField == 'Finance' ? 'selected' : '' }}>التمويل</option>
                <option value="Healthcare" {{ $company->jobField == 'Healthcare' ? 'selected' : '' }}>الرعاية الصحية</option>
            </select>
            @error('jobField') <span class="invalid-feedback"><strong>{{ $message }}</strong></span> @enderror

            <label for="location">الموقع</label>
            <select name="location" id="location" class="form-control @error('location') is-invalid @enderror">
                <option value="" disabled>اختر المحافظة</option>
                <option value="صنعاء" {{ $company->location == 'صنعاء' ? 'selected' : '' }}>صنعاء</option>
                <option value="عدن" {{ $company->location == 'عدن' ? 'selected' : '' }}>عدن</option>
            </select>
            @error('location') <span class="invalid-feedback"><strong>{{ $message }}</strong></span> @enderror

            <label for="mission">المهمة</label>
            <textarea name="mission" id="mission" class="form-control @error('mission') is-invalid @enderror">{!! $company->mission !!}</textarea>
            @error('mission') <span class="invalid-feedback"><strong>{{ $message }}</strong></span> @enderror

            <label for="vision">الرؤية</label>
            <textarea name="vision" id="vision" class="form-control @error('vision') is-invalid @enderror">{!! $company->vision !!}</textarea>
            @error('vision') <span class="invalid-feedback"><strong>{{ $message }}</strong></span> @enderror

            <label for="aboutus">نبذة عن الشركة</label>
            <textarea name="aboutus" id="aboutus" class="form-control @error('aboutus') is-invalid @enderror">{!! $company->aboutus !!}</textarea>
            @error('aboutus') <span class="invalid-feedback"><strong>{{ $message }}</strong></span> @enderror

            <label for="dateOfCreation">تاريخ الإنشاء</label>
            <input type="date" name="dateOfCreation" id="dateOfCreation"
                class="form-control @error('dateOfCreation') is-invalid @enderror" value="{{ $company->dateOfCreation }}">
            @error('dateOfCreation') <span class="invalid-feedback"><strong>{{ $message }}</strong></span> @enderror

            <label for="logo">شعار الشركة</label>
            @if($company->logo)
                <p>الشعار الحالي:</p>
                <img src="{{ asset('storage/logos/'.$company->logo) }}" alt="Current Logo" width="100">
                <p>{{ $company->logo }}</p>
            @endif
            <input type="file" name="logo" id="logo">
            @error('logo') <span class="invalid-feedback"><strong>{{ $message }}</strong></span> @enderror

            <label for="record">السجل التجاري</label>
            @if($company->commercialRegister)
                <p>السجل التجاري الحالي:</p>
                <a href="{{ asset('storage/records/'.$company->commercialRegister) }}" target="_blank">عرض السجل التجاري</a>
            @endif
            <input type="file" name="commercialRegister" id="record">
            @error('commercialRegister') <span class="invalid-feedback"><strong>{{ $message }}</strong></span> @enderror

            <button type="submit" class="btn">تحديث</button>
        </form>
    </div>

    @include('includes.footer')
    <script>
         document.addEventListener("DOMContentLoaded", function() {
        tinymce.init({
            selector: '#mission, #vision, #aboutus',
            menubar: false,
            plugins: 'lists link',
            toolbar: 'bold italic underline strikethrough | bullist numlist blockquote | link',
            setup: function (editor) {
                editor.on('change', function () {
                    tinymce.triggerSave();
                });
            }
        });
    });
    </script>

</body>
</html>
