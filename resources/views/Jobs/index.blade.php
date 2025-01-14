<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('CSS/jobs.css')}}">
    <link rel="stylesheet" href="{{asset('CSS/search.css')}}">
    <title>Jobs</title>
</head>
<body>
    @include('includes.header')
    <div class="search-box">
        <input type="text" placeholder="ابحث عن الوظائف والشركات">
        <div class="dropdown">
            <input class="dropdown-toggle" onclick="toggleDropdown()" id="locationInput" placeholder="جميع المواقع">
            <div class="dropdown-menu" id="dropdownMenu">
                <input type="text" class="dropdown-search" placeholder="بحث..." oninput="filterDropdown(this)">
                <ul class="dropdown-list">
                    <li onclick="selectLocation(this)">جميع المواقع</li>
                    <li onclick="selectLocation(this)">الأردن</li>
                    <li onclick="selectLocation(this)">عمان</li>
                    <li onclick="selectLocation(this)">الإمارات العربية المتحدة</li>
                    <li onclick="selectLocation(this)">الإمارات العربية المتحدة: أبو ظبي</li>
                    <li onclick="selectLocation(this)">الإمارات العربية المتحدة: عجمان</li>
                </ul>
            </div>
        </div>
        <button>بحث</button>
    </div>
    <div class="container">
            <h1>وظائف في اليمن</h1>
            <p>تم العثور على <span>43.1K</span> وظيفة</p>

        <div class="filters">
            <label for="sort">الترتيب حسب:</label>
            <select id="sort">
                <option value="language">التاريخ</option>
                <option value="language">الشركة</option>
                <option value="language">المحافظة</option>
            </select>
        </div>

        <div class="job-listing">

                <div class="job-card">
                    <div class="favorite" onclick="event.stopPropagation();">
                        <i class="heart-icon" onclick="toggleFavorite(this)">&#9829;</i>
                    </div>
                    <a href="{{route('jobs.details')}}" class="job-card-link">
                        <div class="job-info">
                            <h2 class="job-title">مطلوب مندوب / مسؤول مبيعات</h2>
                            <div class="company">
                                <img src="logo-placeholder.png" alt="Logo" class="logo">
                                <span>yemnak company</span>
                            </div>
                            <span class="location">صنعاء</span>
                            <p>مندوب، مسؤول مبيعات لشركة صيانة تكييف  . خبرة لا تقل عن 3 سنوات...</p>
                            <span class="salary">$1,000 - $500</span>
                            <span class="time-posted">قبل 45 دقيقة</span>
                        </div>
                    </a>
                    <div class="apply-btn" onclick="event.stopPropagation();">
                            <button onclick="window.location.href={{route('jobs.apply')}}";>التقديم السريع</button>
                    </div>
                </div>
        </div>

    </div>
    @include('includes.footer')
    <script>
        function toggleFavorite(icon) {
            icon.style.color = icon.style.color === 'red' ? '#ccc' : 'red';
        }
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
            const dropdown = document.getElementById("dropdownMenu");

            input.value = item.innerText;

            dropdown.style.display = "none";
        }
    </script>
</body>
</html>
