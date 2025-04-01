<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('CSS/jobs/add.css') }}">
    <script src="{{ asset('tinymce/js/tinymce/tinymce.min.js') }}"></script>
    <title>تعديل عمل</title>
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
                    <option value="المحويت">المحويت</option>
                    <option value="ريمة">ريمة</option>
                    <option value="عمران">عمران</option>
                    <option value="الجوف">الجوف</option>
                    <option value="البيضاء">البيضاء</option>
                    <option value="شبوة">شبوة</option>
                    <option value="المهرة">المهرة</option>
                    <option value="حضرموت">حضرموت</option>
                    <option value="لحج">لحج</option>
                    <option value="أبين">أبين</option>
                    <option value="سقطرى">سقطرى</option>
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
        <h2>تعديل وظيفة </h2>

        <form action="{{ route('jobs.update',$job->id) }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <div>
                    <label for="jobName">اسم الوظيفة:</label>
                    <input type="text" id="jobName" name="jobName" class="form-control @error('jobName') is-invalid @enderror" value="{{ old('jobName', $job->jobName) }}" required>
                    @error('jobName')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
                <div>
                    <label for="jobType">نوع الوظيفة:</label>
                    <select id="jobType" name="jobType" class="form-control @error('jobType') is-invalid @enderror" required onchange="toggleLocation()">
                        <option value="دوام كامل" {{ old('jobType', $job->jobType) == 'دوام كامل' ? 'selected' : '' }}>دوام كامل</option>
                    <option value="دوام جزئي" {{ old('jobType', $job->jobType) == 'دوام جزئي' ? 'selected' : '' }}>دوام جزئي</option>
                    <option value="عن بعد" {{ old('jobType', $job->jobType) == 'عن بعد' ? 'selected' : '' }}>عن بعد</option>
                    </select>
                    @error('jobType')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="description" class="full-width">الوصف:</label>
                <textarea id="description" name="description" class="form-control @error('description') is-invalid @enderror" required>{{ old('description', $job->description) }}</textarea>
                @error('description')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </div>

            <div class="form-group">
                <div>
                    <label for="minSalary">الحد الأدنى للراتب:</label>
                    <input type="number" id="minSalary" name="minSalary" class="form-control @error('minSalary') is-invalid @enderror" value="{{ old('minSalary',$job->minSalary) }}" required>
                    @error('minSalary')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
                <div>
                    <label for="maxSalary">الحد الأقصى للراتب:</label>
                    <input type="number" id="maxSalary" name="maxSalary" class="form-control @error('maxSalary') is-invalid @enderror" value="{{ old('maxSalary',$job->maxSalary) }}" required>
                    @error('maxSalary')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <div>
                    <label for="currency">العملة:</label>
                    <select id="currency" name="currency" class="form-control @error('currency') is-invalid @enderror" required>
                        <option value="YEM" {{ old('currency',$job->currency) == 'YEM' ? 'selected' : '' }}>ريال يمني</option>
                        <option value="SAR" {{ old('currency',$job->currency) == 'SAR' ? 'selected' : '' }}>ريال سعودي</option>
                        <option value="USD" {{ old('currency',$job->currency) == 'USD' ? 'selected' : '' }}>دولار امريكي</option>
                    </select>
                    @error('currency')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
                <div>
                    <label for="expirationDate">تاريخ انتهاء الإعلان:</label>
                    <input type="date" id="expirationDate" name="expirationDate" class="form-control @error('expirationDate') is-invalid @enderror" value="{{ old('expirationDate',$job->expirationDate) }}" required>
                    @error('expirationDate')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="requirements" class="full-width">المتطلبات:</label>
                <textarea id="requirements" name="requirements" class="form-control @error('requirements') is-invalid @enderror" required>{{ old('requirements',$job->requirements) }}</textarea>
                @error('requirements')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </div>

            <div class="form-group" id="locationField">
                <div>
                    <label for="location">الموقع:</label>
                    <select name="location" id="location" class="form-control @error('location') is-invalid @enderror">
                        <option value="صنعاء" {{ old('location',$job->location) == 'صنعاء' ? 'selected' : '' }}>صنعاء</option>
                        <option value="عدن" {{ old('location',$job->location) == 'عدن' ? 'selected' : '' }}>عدن</option>
                        <option value="تعز" {{ old('location',$job->location) == 'تعز' ? 'selected' : '' }}>تعز</option>
                        <option value="الحديدة" {{ old('location',$job->location) == 'الحديدة' ? 'selected' : '' }}>الحديدة</option>
                        <option value="المكلا" {{ old('location',$job->location) == 'المكلا' ? 'selected' : '' }}>المكلا</option>
                        <option value="إب" {{ old('location',$job->location) == 'إب' ? 'selected' : '' }}>إب</option>
                        <option value="سيئون" {{ old('location',$job->location) == 'سيئون' ? 'selected' : '' }}>سيئون</option>
                        <option value="الغيضة" {{ old('location',$job->location) == 'الغيضة' ? 'selected' : '' }}>الغيضة</option>
                        <option value="ذمار" {{ old('location',$job->location) == 'ذمار' ? 'selected' : '' }}>ذمار</option>
                        <option value="حجة" {{ old('location',$job->location) == 'حجة' ? 'selected' : '' }}>حجة</option>
                        <option value="المحويت" {{ old('location',$job->location) == 'المحويت' ? 'selected' : '' }}>المحويت</option>
                        <option value="ريمة" {{ old('location',$job->location) == 'ريمة' ? 'selected' : '' }}>ريمة</option>
                        <option value="عمران" {{ old('location',$job->location) == 'عمران' ? 'selected' : '' }}>عمران</option>
                        <option value="الجوف" {{ old('location',$job->location) == 'الجوف' ? 'selected' : '' }}>الجوف</option>
                        <option value="البيضاء" {{ old('location',$job->location) == 'البيضاء' ? 'selected' : '' }}>البيضاء</option>
                        <option value="شبوة" {{ old('location',$job->location) == 'شبوة' ? 'selected' : '' }}>شبوة</option>
                        <option value="المهرة" {{ old('location',$job->location) == 'المهرة' ? 'selected' : '' }}>المهرة</option>
                        <option value="حضرموت" {{ old('location',$job->location) == 'حضرموت' ? 'selected' : '' }}>حضرموت</option>
                        <option value="لحج" {{ old('location',$job->location) == 'لحج' ? 'selected' : '' }}>لحج</option>
                        <option value="أبين" {{ old('location',$job->location) == 'أبين' ? 'selected' : '' }}>أبين</option>
                        <option value="سقطرى" {{ old('location',$job->location) == 'سقطرى' ? 'selected' : '' }}>سقطرى</option>
                    </select>
                    @error('location')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
            </div>

            <button type="submit">تعديل الوظيفة</button>
        </form>

    </div>

    @include('includes.footer')

</body>
</html>
