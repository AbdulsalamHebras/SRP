<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('CSS/jobs/add.css') }}">
    <script src="{{ asset('tinymce/js/tinymce/tinymce.min.js') }}"></script>
    <title>إضافة عمل</title>
    <style>
        .invalid-feedback {
            color: red;
        }
    </style>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            toggleLocation(); // تشغيل الوظيفة عند تحميل الصفحة

            tinymce.init({
                selector: '#requirements,#description',
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

        function toggleLocation() {
            var jobType = document.getElementById("jobType").value;
            var locationSelect = document.getElementById("location");

            if (jobType === "عن بعد") {
                locationSelect.innerHTML = '<option value="عن بعد">عن بعد</option>';
                locationSelect.setAttribute("disabled", "true");
                locationSelect.removeAttribute("required");
            } else {
                locationSelect.innerHTML = `
                    <option value="صنعاء">صنعاء</option>
                    <option value="عدن">عدن</option>
                    <option value="تعز">تعز</option>
                    <option value="الحديدة">الحديدة</option>
                    <option value="المكلا">المكلا</option>
                    <option value="إب">إب</option>
                    <option value="سيئون">سيئون</option>
                    <option value="الغيضة">الغيضة</option>
                    <option value="ذمار">ذمار</option>
                    <option value="حجة">حجة</option>
                `;
                locationSelect.removeAttribute("disabled");
                locationSelect.setAttribute("required", "true"); 
            }
        }
    </script>
</head>
<body>

    @include('includes.header')

    <div class="container">
        <h2>إضافة وظيفة جديدة</h2>

        <form action="{{ route('jobs.add') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <div>
                    <label for="jobName">اسم الوظيفة:</label>
                    <input type="text" id="jobName" name="jobName" class="form-control @error('jobName') is-invalid @enderror" value="{{ old('jobName') }}" required>
                    @error('jobName')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
                <div>
                    <label for="jobType">نوع الوظيفة:</label>
                    <select id="jobType" name="jobType" class="form-control @error('jobType') is-invalid @enderror" required onchange="toggleLocation()">
                        <option value="دوام كامل" {{ old('jobType') == 'دوام كامل' ? 'selected' : '' }}>دوام كامل</option>
                        <option value="دوام جزئي" {{ old('jobType') == 'دوام جزئي' ? 'selected' : '' }}>دوام جزئي</option>
                        <option value="عن بعد" {{ old('jobType') == 'عن بعد' ? 'selected' : '' }}>عن بعد</option>
                    </select>
                    @error('jobType')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="description" class="full-width">الوصف:</label>
                <textarea id="description" name="description" class="form-control @error('description') is-invalid @enderror" required>{{ old('description') }}</textarea>
                @error('description')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </div>

            <div class="form-group">
                <div>
                    <label for="minSalary">الحد الأدنى للراتب:</label>
                    <input type="number" id="minSalary" name="minSalary" class="form-control @error('minSalary') is-invalid @enderror" value="{{ old('minSalary') }}" required>
                    @error('minSalary')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
                <div>
                    <label for="maxSalary">الحد الأقصى للراتب:</label>
                    <input type="number" id="maxSalary" name="maxSalary" class="form-control @error('maxSalary') is-invalid @enderror" value="{{ old('maxSalary') }}" required>
                    @error('maxSalary')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <div>
                    <label for="currency">العملة:</label>
                    <select id="currency" name="currency" class="form-control @error('currency') is-invalid @enderror" required>
                        <option value="YEM" {{ old('currency') == 'YEM' ? 'selected' : '' }}>ريال يمني</option>
                        <option value="SAR" {{ old('currency') == 'SAR' ? 'selected' : '' }}>ريال سعودي</option>
                        <option value="USD" {{ old('currency') == 'USD' ? 'selected' : '' }}>دولار امريكي</option>
                    </select>
                    @error('currency')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
                <div>
                    <label for="expirationDate">تاريخ انتهاء الإعلان:</label>
                    <input type="date" id="expirationDate" name="expirationDate" class="form-control @error('expirationDate') is-invalid @enderror" value="{{ old('expirationDate') }}" required>
                    @error('expirationDate')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="requirements" class="full-width">المتطلبات:</label>
                <textarea id="requirements" name="requirements" class="form-control @error('requirements') is-invalid @enderror" required>{{ old('requirements') }}</textarea>
                @error('requirements')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </div>

            <div class="form-group" id="locationField">
                <div>
                    <label for="location">الموقع:</label>
                    <select name="location" id="location" class="form-control @error('location') is-invalid @enderror">
                        <option value="صنعاء" {{ old('location') == 'صنعاء' ? 'selected' : '' }}>صنعاء</option>
                        <option value="عدن" {{ old('location') == 'عدن' ? 'selected' : '' }}>عدن</option>
                        <option value="تعز" {{ old('location') == 'تعز' ? 'selected' : '' }}>تعز</option>
                        <option value="الحديدة" {{ old('location') == 'الحديدة' ? 'selected' : '' }}>الحديدة</option>
                        <option value="المكلا" {{ old('location') == 'المكلا' ? 'selected' : '' }}>المكلا</option>
                        <option value="إب" {{ old('location') == 'إب' ? 'selected' : '' }}>إب</option>
                        <option value="سيئون" {{ old('location') == 'سيئون' ? 'selected' : '' }}>سيئون</option>
                        <option value="الغيضة" {{ old('location') == 'الغيضة' ? 'selected' : '' }}>الغيضة</option>
                        <option value="ذمار" {{ old('location') == 'ذمار' ? 'selected' : '' }}>ذمار</option>
                        <option value="حجة" {{ old('location') == 'حجة' ? 'selected' : '' }}>حجة</option>
                    </select>
                    @error('location')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
            </div>

            <button type="submit">إضافة الوظيفة</button>
        </form>

    </div>

    @include('includes.footer')

</body>
</html>
