<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="{{asset('CSS/login.css')}}">

</head>
<body>
    <div class="login-container">
        <!-- Logo -->
        <div class="logo">
            <img src="https://via.placeholder.com/100" alt="Logo">
        </div>

        <!-- Form Fields -->
        <form id="registerForm">
            <input type="text" name="username" placeholder="اسم المستخدم" id="username" required>
            <input type="text" name="email" placeholder="البريد الإلكتروني" id="email" required>
            <select id="userType" name="accountType" required>
                <option value="">نوع الحساب</option>
                <option value="applier">باحث عن عمل</option>
                <option value="company">شركة</option>
            </select>
            <div id="record-container">
                <label for="record">ارفق صورة للسجل التجاري</label>
                <input type="file" name="record" id="record">
            </div>
            <input type="password" name="password" placeholder="كلمة المرور" id="password" required>
            <input type="password" name="confirm-password" placeholder="تأكيد كلمة المرور" id="confirm-password" required>

            <button type="submit" class="btn">إنشاء</button>
        </form>
    </div>

    <script>
        const userType = document.getElementById('userType');
        const recordContainer = document.getElementById('record-container');

        userType.addEventListener('change', function() {
            if (userType.value === 'company') {
                recordContainer.style.display = 'block'; // Show record input
                document.getElementById('record').setAttribute('required', true); // Make it required
            } else {
                recordContainer.style.display = 'none'; // Hide record input
                document.getElementById('record').removeAttribute('required'); // Remove required attribute
            }
        });
    </script>
</body>
</html>
