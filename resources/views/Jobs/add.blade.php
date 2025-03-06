<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>إضافة عمل</title>
    <script>
        function toggleLocation() {
            var jobType = document.getElementById("jobType").value;
            var locationField = document.getElementById("locationField");
            var locationInput = document.getElementById("location");

            if (jobType === "عن بعد") {
                locationField.style.display = "none";
                locationInput.value = "عن بعد";
            } else {
                locationField.style.display = "block"; 
            }
        }
    </script>
</head>
<body>
    @include('includes.header')

    <form action="" method="POST">
        @csrf

        <label for="jobName">اسم الوظيفة:</label>
        <input type="text" id="jobName" name="jobName" required>

        <label for="description">الوصف:</label>
        <textarea id="description" name="description" required></textarea>

        <label for="jobType">نوع الوظيفة:</label>
        <select id="jobType" name="jobType" required onchange="toggleLocation()">
            <option value="دوام كامل" selected>دوام كامل</option>
            <option value="دوام جزئي">دوام جزئي</option>
            <option value="عن بعد">عن بعد</option>
        </select>

        <label for="minSalary">الحد الأدنى للراتب:</label>
        <input type="number" id="minSalary" name="minSalary" required>

        <label for="maxSalary">الحد الأقصى للراتب:</label>
        <input type="number" id="maxSalary" name="maxSalary" required>

        <label for="currency">العملة:</label>
        <select id="currency" name="currency" required>
            <option value="YEM" selected>ريال يمني</option>
            <option value="SAR">ريال سعودي</option>
            <option value="USD">دولار امريكي</option>
        </select>

        <label for="requirements">المتطلبات:</label>
        <textarea id="requirements" name="requirements" required></textarea>

        <label for="expirationDate">تاريخ انتهاء الإعلان:</label>
        <input type="date" id="expirationDate" name="expirationDate" required>

        <div id="locationField">
            <label for="location">الموقع:</label>
            <select name="location" id="location" class="form-control @error('location') is-invalid @enderror">
                <option value="صنعاء" {{ old('location', auth()->guard('company')->user()->location) == 'صنعاء' ? 'selected' : '' }}>صنعاء</option>
                <option value="عدن" {{ old('location', auth()->guard('company')->user()->location) == 'عدن' ? 'selected' : '' }}>عدن</option>
                <option value="تعز" {{ old('location', auth()->guard('company')->user()->location) == 'تعز' ? 'selected' : '' }}>تعز</option>
                <option value="الحديدة" {{ old('location', auth()->guard('company')->user()->location) == 'الحديدة' ? 'selected' : '' }}>الحديدة</option>
                <option value="المكلا" {{ old('location', auth()->guard('company')->user()->location) == 'المكلا' ? 'selected' : '' }}>المكلا</option>
                <option value="إب" {{ old('location', auth()->guard('company')->user()->location) == 'إب' ? 'selected' : '' }}>إب</option>
                <option value="سيئون" {{ old('location', auth()->guard('company')->user()->location) == 'سيئون' ? 'selected' : '' }}>سيئون</option>
                <option value="الغيضة" {{ old('location', auth()->guard('company')->user()->location) == 'الغيضة' ? 'selected' : '' }}>الغيضة</option>
                <option value="ذمار" {{ old('location', auth()->guard('company')->user()->location) == 'ذمار' ? 'selected' : '' }}>ذمار</option>
                <option value="حجة" {{ old('location', auth()->guard('company')->user()->location) == 'حجة' ? 'selected' : '' }}>حجة</option>
            </select>
        </div>

        <button type="submit">إضافة الوظيفة</button>
    </form>

    @include('includes.footer')

    <script>
        window.onload = toggleLocation;
    </script>

</body>
</html>
