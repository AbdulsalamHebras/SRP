<!DOCTYPE html>
<html lang="ar"dir='rtl' >
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('CSS/search.css')}}">


</head>
<body>
    <div class="search-box">
        <input type="text" placeholder="ابحث عن الوظائف والشركات">
        <div class="dropdown">
            <input class="dropdown-toggle" onclick="toggleDropdown()" id="locationInput" placeholder="جميع المواقع">
            <div class="dropdown-menu" id="dropdownMenu">
                <input type="text" class="dropdown-search" placeholder="بحث..." oninput="filterDropdown(this)">
                <ul class="dropdown-list">
                    <li onclick="selectLocation(this)">جميع المواقع</li>
                    <li onclick="selectLocation(this)">صنعاء</li>
                    <li onclick="selectLocation(this)">عدن</li>
                    <li onclick="selectLocation(this)">تعز</li>
                    <li onclick="s electLocation(this)">مارب</li>
                    <li onclick="selectLocation(this)">الضالع</li>
                    <li onclick="selectLocation(this)">الحديدة</li>
                </ul>
            </div>
        </div>
        <button>بحث</button>
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
            const dropdown = document.getElementById("dropdownMenu");

            input.value = item.innerText;

            dropdown.style.display = "none";
        }
    </script>

</body>
</html>

