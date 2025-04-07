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
                    <a href="{{route('company.appliers')}}" class="nav-link {{ request()->routeIs('company.appliers') ? 'active' : '' }}">طلبات التوظيف</a>
                @else
                    <a href="{{route('main')}}" class="nav-link {{ request()->routeIs('main') ? 'active' : '' }}">الرئيسية</a>
                    <a href="{{route('jobs.index')}}" class="nav-link {{ request()->routeIs('jobs.index') ? 'active' : '' }}">البحث عن وظائف</a>
                    <a href="{{route('companies.index')}}" class="nav-link {{ request()->routeIs('companies.index') ? 'active' : '' }}">الشركات</a>
                    <a href="{{route('user.appliments')}}" class="nav-link {{ request()->routeIs('user.appliments') ? 'active' : '' }}">طلبات التوظيف</a>
                    {{-- <a href="" class="nav-link {{ request()->routeIs('') ? 'active' : '' }}">من شاهد سيرتي؟</a> --}}
                @endif
            </div>


            <div class="hamburger-menu" id="hamburger-menu">
                <div></div>
                <div></div>
                <div></div>
            </div>

            <div class="close-btn" id="close-btn">&times;</div>

            @if(Auth::guard('web')->check())
                @php
                    $userEmail = Auth::user()->email;
                    $notifications = \Illuminate\Support\Facades\DB::table('notifications')
                        ->where('notifiable_type', 'App\\Models\\Applier')
                        ->whereNull('read_at')
                        ->get()
                        ->filter(function ($notification) use ($userEmail) {
                            $data = json_decode($notification->data, true);
                            $applierId = $data['applier_id'] ?? null;
                            if (!$applierId) return false;

                            $applier = \App\Models\Applier::find($applierId);
                            return $applier && $applier->email === $userEmail;
                        });
                @endphp

                <div class="message-dropdown" id="message-dropdown">
                    <div class="message-icon" id="message-icon">
                        <i class="fa fa-envelope"></i>
                        <div class="notification-badge">{{ $notifications->count() }}</div>
                    </div>
                    <div class="message-dropdown-content" id="message-dropdown-content">
                        <h4 style="color: black">الرسائل الجديدة</h4>

                        @forelse ($notifications as $note)
                            @php
                                $data = json_decode($note->data, true);
                                $job = \App\Models\Job::find($data['job_id'] ?? 0);
                                $company = $job ? $job->company->name : 'شركة غير معروفة';
                                $jobTitle = $job ? $job->jobName : 'وظيفة غير معروفة';
                                $date = $data['date'] ?? 'تاريخ غير محدد';
                                $time = $data['time'] ?? 'وقت غير محدد';
                                $noteText = $data['notes'] ?? 'لا توجد ملاحظات';
                            @endphp

                            <div class="notification-item"
                                data-id="{{ $note->id }}"
                                data-date="{{ $date }}"
                                data-time="{{ $time }}"
                                data-company="{{ $company }}"
                                data-job="{{ $jobTitle }}"
                                data-note="{{ $noteText }}">
                                <p>
                                    تم حجز موعد مقابلة لوظيفة <strong>{{ $jobTitle }}</strong>
                                </p>
                            </div>
                        @empty
                            <p>لا توجد رسائل غير مقروءة.</p>
                        @endforelse


                    </div>
                </div>
            @endif
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
    <!-- Modal -->
    <div class="modal" id="interviewModal" style="display: none;">
        <div class="modal-content">
            <span class="close" id="closeModal">&times;</span>
            <h2>تحديد موعد المقابلة</h2>

            <div>
                <label><strong>تاريخ المقابلة:</strong></label>
                <p id="modalDate"></p>
            </div>

            <div>
                <label><strong>وقت المقابلة:</strong></label>
                <p id="modalTime"></p>
            </div>

            <div>
                <label><strong>الشركة:</strong></label>
                <p id="modalCompany"></p>
            </div>

            <div>
                <label><strong>الوظيفة:</strong></label>
                <p id="modalJob"></p>
            </div>

            <div>
                <label><strong>ملاحظات:</strong></label>
                <p id="modalNote"></p>
            </div>
        </div>
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const hamburgerMenu = document.getElementById('hamburger-menu');
            const navLinks = document.getElementById('nav-links');
            const closeBtn = document.getElementById('close-btn');
            const messageDropdown = document.getElementById('message-dropdown');
            const messageIcon = document.getElementById('message-icon');
            const messageDropdownContent = document.getElementById('message-dropdown-content');
            const unreadCount = document.querySelector('.notification-badge'); // عداد الإشعارات غير المقروءة
            let currentNotification = null;

            // قائمة الروابط
            const navLinksItems = document.querySelectorAll('.nav-link');
            navLinksItems.forEach(item => {
                item.addEventListener('click', () => {
                    navLinksItems.forEach(link => link.classList.remove('active'));
                    item.classList.add('active');
                });
            });

            // التعامل مع القائمة المنبثقة
            hamburgerMenu.addEventListener('click', () => {
                navLinks.classList.toggle('open');
                closeBtn.style.display = 'block';
            });

            closeBtn.addEventListener('click', () => {
                navLinks.classList.remove('open');
                closeBtn.style.display = 'none';
            });

            // التعامل مع الرسائل المنبثقة
            messageIcon.addEventListener('click', (event) => {
                event.stopPropagation();
                messageDropdownContent.classList.toggle('show');
            });

            document.addEventListener('click', (event) => {
                if (!messageDropdown.contains(event.target)) {
                    messageDropdownContent.classList.remove('show');
                }
            });

            // عرض تفاصيل الإشعار عند النقر عليه
            document.querySelectorAll('.notification-item').forEach(item => {
                item.addEventListener('click', function () {
                    currentNotification = this; // حفظ العنصر الحالي

                    document.getElementById('modalDate').innerText = this.dataset.date;
                    document.getElementById('modalTime').innerText = this.dataset.time;
                    document.getElementById('modalCompany').innerText = this.dataset.company;
                    document.getElementById('modalJob').innerText = this.dataset.job;
                    document.getElementById('modalNote').innerText = this.dataset.note;

                    document.getElementById('interviewModal').style.display = 'block';
                });
            });

            // إغلاق المودال عند النقر على زر الإغلاق
            document.getElementById('closeModal').addEventListener('click', function () {
                document.getElementById('interviewModal').style.display = 'none';

                if (currentNotification) {
                    const id = currentNotification.dataset.id;

                    fetch("{{ route('notifications.markAsRead') }}", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        },
                        body: JSON.stringify({ id })
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            currentNotification.remove(); // حذف الإشعار من الواجهة

                            // تقليل عداد الإشعارات غير المقروءة
                            let currentUnread = parseInt(unreadCount.innerText) || 0;
                            unreadCount.innerText = Math.max(0, currentUnread - 1); // تقليص العدد
                        }
                    });
                }
            });

            // إغلاق المودال عند النقر خارج المودال
            window.addEventListener('click', function(event) {
                const modal = document.getElementById('interviewModal');
                if (event.target === modal) {
                    modal.style.display = 'none';

                    if (currentNotification) {
                        const id = currentNotification.dataset.id;

                        fetch("{{ route('notifications.markAsRead') }}", {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/json",
                                "X-CSRF-TOKEN": "{{ csrf_token() }}"
                            },
                            body: JSON.stringify({ id })
                        })
                        .then(res => res.json())
                        .then(data => {
                            if (data.success) {
                                currentNotification.remove();

                                // تقليل عداد الإشعارات غير المقروءة
                                let currentUnread = parseInt(unreadCount.innerText) || 0;
                                unreadCount.innerText = Math.max(0, currentUnread - 1); // تقليص العدد
                            }
                        });
                    }
                }
            });

        });

    </script>

</body>
</html>

