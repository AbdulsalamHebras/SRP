<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('CSS/search.css') }}">
</head>
<body>
    <div class="search-box">
        <form action="{{ route('jobs.search') }}" method="GET">
            <input type="text" name="search" placeholder="{{ request()->is('companies') ? 'ابحث عن الشركات' : 'ابحث عن الوظائف والشركات' }}" value="{{ request('search') }}">

            <!-- Hidden input for location -->
            <input type="hidden" id="locationInputHidden" name="location" value="{{ request('location') }}">

            <div class="dropdown">
                <input type="text" class="dropdown-toggle" id="locationInput" onclick="toggleDropdown()" placeholder="جميع المواقع" value="{{ request('location') }}">
                <div class="dropdown-menu" id="dropdownMenu">
                    <input type="text" class="dropdown-search" placeholder="بحث..." oninput="filterDropdown(this)">
                    <ul class="dropdown-list">
                        <li onclick="selectLocation(this)">جميع المواقع</li>
                        <li onclick="selectLocation(this)">صنعاء</li>
                        <li onclick="selectLocation(this)">عدن</li>
                        <li onclick="selectLocation(this)">تعز</li>
                        <li onclick="selectLocation(this)">مارب</li>
                        <li onclick="selectLocation(this)">الضالع</li>
                        <li onclick="selectLocation(this)">الحديدة</li>
                        <li onclick="selectLocation(this)">إب</li>
                        <li onclick="selectLocation(this)">ذمار</li>
                        <li onclick="selectLocation(this)">صعدة</li>
                        <li onclick="selectLocation(this)">حجة</li>
                        <li onclick="selectLocation(this)">المحويت</li>
                        <li onclick="selectLocation(this)">ريمة</li>
                        <li onclick="selectLocation(this)">عمران</li>
                        <li onclick="selectLocation(this)">الجوف</li>
                        <li onclick="selectLocation(this)">البيضاء</li>
                        <li onclick="selectLocation(this)">شبوة</li>
                        <li onclick="selectLocation(this)">المهرة</li>
                        <li onclick="selectLocation(this)">حضرموت</li>
                        <li onclick="selectLocation(this)">لحج</li>
                        <li onclick="selectLocation(this)">أبين</li>
                        <li onclick="selectLocation(this)">سقطرى</li>
                        <li onclick="selectLocation(this)">عن بعد</li>
                    </ul>
                </div>
            </div>

            <button type="submit">بحث</button>
        </form>
    </div>

    <script>
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
            const hiddenInput = document.getElementById("locationInputHidden");
            const dropdown = document.getElementById("dropdownMenu");

            // Update both visible input and hidden input with the selected location
            input.value = item.innerText;
            hiddenInput.value = item.innerText;

            dropdown.style.display = "none";  // Close the dropdown
        }
    </script>

</body>
</html>
