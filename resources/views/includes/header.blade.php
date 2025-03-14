<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Header</title>
    <link rel="stylesheet" href="{{asset('CSS/includes/header.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body class="general-page">
    <header>

        <div class="header-container">
            <div class="logo">
                <a href="{{route('home')}}">
                    <h1>ط<span>موح</span></h1>
                </a>
            </div>
            <div class="nav-links" id="nav-links">
                @if (Auth::guard('company')->check())
                    <a href="{{route('company.dashboard')}}" class="nav-link {{ request()->routeIs('company.dashboard') ? 'active' : '' }}">معلومات الشركة</a>
                    <a href="{{route('company.jobs')}}" class="nav-link {{ request()->routeIs('company.jobs') ? 'active' : '' }}">الأعمال</a>
                    <a href="" class="nav-link {{ request()->routeIs('') ? 'active' : '' }}">طلبات التوظيف</a>
                @else
                    <a href="{{route('main')}}" class="nav-link {{ request()->routeIs('main') ? 'active' : '' }}">الرئيسية</a>
                    <a href="{{route('jobs.index')}}" class="nav-link {{ request()->routeIs('jobs.index') ? 'active' : '' }}">البحث عن وظائف</a>
                    <a href="{{route('companies.index')}}" class="nav-link {{ request()->routeIs('companies.index') ? 'active' : '' }}">الشركات</a>
                    <a href="{{route('user.appliments')}}" class="nav-link {{ request()->routeIs('user.appliments') ? 'active' : '' }}">طلبات التوظيف</a>
                    <a href="" class="nav-link {{ request()->routeIs('') ? 'active' : '' }}">من شاهد سيرتي؟</a>
                @endif
            </div>


            <div class="hamburger-menu" id="hamburger-menu">
                <div></div>
                <div></div>
                <div></div>
            </div>

            <div class="close-btn" id="close-btn">&times;</div>

            <div class="message-dropdown" id="message-dropdown">
                <div class="message-icon" id="message-icon">
                    <i class="fa fa-envelope"></i>
                    <div class="notification-badge">3</div>
                </div>
                <div class="message-dropdown-content" id="message-dropdown-content">
                    <h4>الرسائل الجديدة</h4>
                    <p>لديك رسائل غير مقروءة.</p>
                    <a href="#">عرض الكل</a>
                </div>
            </div>

            <div class="auth-links">
                @if(Auth::guard('web')->check())
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="nav-link"><img src="{{asset('images/Icons/logout.png')}}" alt="" height="30px" width="30px"></button>
                    </form>
                @elseif (Auth::guard('company')->check())
                    <form action="{{ route('companies.logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="nav-link"><img src="{{asset('images/Icons/logout.png')}}" alt="" height="30px" width="30px"></button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="nav-link"> <img src="{{asset('images/Icons/login.png')}}" alt=""  height="30px" width="30px"> </a>
                    <a href="{{ route('register') }}" class="nav-link"> <img src="{{asset('images/Icons/register.png')}}" alt=""  height="30px" width="30px">  </a>
                @endif

            </div>
        </div>
    </header>

    <script>
        const hamburgerMenu = document.getElementById('hamburger-menu');
        const navLinks = document.getElementById('nav-links');
        const closeBtn = document.getElementById('close-btn');
        const navLinksItems = document.querySelectorAll('.nav-link');
        closeBtn.style.display = 'none';


        navLinksItems.forEach(item => {
            item.addEventListener('click', () => {
                // Remove 'active' class from all links
                navLinksItems.forEach(link => link.classList.remove('active'));
                // Add 'active' class to the clicked link
                item.classList.add('active');
            });
        });

        hamburgerMenu.addEventListener('click', () => {
            navLinks.classList.toggle('open');
            closeBtn.style.display = 'block';
        });

        closeBtn.addEventListener('click', () => {
            navLinks.classList.remove('open');
            closeBtn.style.display = 'none';
        });

        // JavaScript for message dropdown
        const messageDropdown = document.getElementById('message-dropdown');
        const messageIcon = document.getElementById('message-icon');
        const messageDropdownContent = document.getElementById('message-dropdown-content');

        // Toggle the message dropdown on icon click
        messageIcon.addEventListener('click', (event) => {
            event.stopPropagation();  // Prevent the click event from bubbling up to document
            messageDropdownContent.classList.toggle('show');
        });

        // Close message dropdown if clicked outside
        document.addEventListener('click', (event) => {
            if (!messageDropdown.contains(event.target)) {
                messageDropdownContent.classList.remove('show');
            }
        });

    </script>

</body>
</html>
