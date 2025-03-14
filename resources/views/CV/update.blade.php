<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('CSS/CV/update.css')}}">

    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />



    <title> {{$applier->name}} CV </title>
</head>
<body>
    @include('includes.header')
    <div class="container">
        <h2>تحديث السيرة الذاتية</h2>
        <form action="/update-cv" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="photo">رفع  الصورة الشخصية</label>
                <input type="file" id="photo" name="photo">
            </div>
            <div class="form-group">
                <label for="name">الاسم الكامل</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">البريد الإلكتروني</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="phone">رقم الهاتف</label>
                <input type="text" id="phone" name="phoneNumber">
            </div>
            <div class="form-group">
                <label for="city">المدينة</label>
                <select id="city" name="city" class="select2">
                    <option value="">اختر المدينة</option>
                    <option value="صنعاء">صنعاء</option>
                    <option value="عدن">عدن</option>
                    <option value="تعز">تعز</option>
                    <option value="الحديدة">الحديدة</option>
                    <option value="المكلا">المكلا</option>
                    <option value="إب">إب</option>
                    <option value="الضالع">الضالع</option>
                    <option value="ذمار">ذمار</option>
                    <option value="حجة">حجة</option>
                    <option value="عمران">عمران</option>
                    <option value="لحج">لحج</option>
                    <option value="المحويت">المحويت</option>
                    <option value="البيضاء">البيضاء</option>
                    <option value="شبوة">شبوة</option>
                    <option value="الجوف">الجوف</option>
                    <option value="صعدة">صعدة</option>
                    <option value="ريمة">ريمة</option>
                    <option value="حضرموت">حضرموت</option>
                    <option value="مأرب">مأرب</option>
                    <option value="المهرة">المهرة</option>
                    <option value="سقطرى">سقطرى</option>
                    <option value="أخرى">أخرى</option>
                </select>
            </div>
            <div class="form-group">
                <label for="degree">المؤهل العلمي</label>
                <select id="degree" name="degree" class="select2">
                    <option value="">اختر المؤهل العلمي</option>
                    <option value="دبلوم">دبلوم</option>
                    <option value="بكالوريوس">بكالوريوس</option>
                    <option value="ماجستير">ماجستير</option>
                    <option value="دكتوراه">دكتوراه</option>
                    <option value="أخرى">أخرى</option>
                </select>
            </div>

            <div class="form-group">
                <label for="specialization">التخصص</label>
                <select id="specialization" name="specialization" class="select2">
                    <option value="">اختر التخصص</option>
                    @foreach([
                        'علوم الحاسوب', 'الذكاء الاصطناعي', 'الأمن السيبراني', 'تحليل البيانات', 'هندسة البرمجيات', 'الروبوتات',
                        'الهندسة الكهربائية', 'الهندسة الميكانيكية', 'الهندسة الطبية الحيوية', 'الهندسة المدنية', 'الهندسة الكيميائية',
                        'الفيزياء التطبيقية', 'علوم الأحياء', 'الطب والجراحة', 'الصيدلة', 'التغذية وعلم الغذاء', 'الاقتصاد',
                        'إدارة الأعمال', 'التسويق الرقمي', 'المحاسبة', 'القانون والتشريعات', 'العلاقات الدولية', 'الإعلام والاتصال',
                        'التصميم الجرافيكي', 'تصميم تجربة المستخدم (UX/UI)', 'الواقع الافتراضي والواقع المعزز', 'الطاقة المتجددة',
                        'إدارة المشاريع', 'علم النفس', 'التربية والتعليم', 'اللغويات والترجمة', 'علوم الفضاء والفلك'
                    ] as $specialization)
                        <option value="{{ $specialization }}">{{ $specialization }}</option>
                    @endforeach
                    <option value="other">أخرى</option>
                </select>
            </div>

            <!-- حقل إدخال التخصص اليدوي (يظهر فقط عند اختيار "أخرى") -->
            <div class="form-group" id="customSpecializationDiv" style="display: none;">
                <label for="customSpecialization">أدخل تخصصك</label>
                <input type="text" id="customSpecialization" name="customSpecialization" placeholder="اكتب تخصصك هنا">
            </div>


            <div class="form-group">
                <label for="languages">اللغات:</label>
                <select name="languages[]" id="languages" multiple>
                    @foreach([
                        'الإنجليزية' => 'English', 'العربية' => 'Arabic', 'الفرنسية' => 'French', 'الإسبانية' => 'Spanish',
                        'الألمانية' => 'German', 'الصينية' => 'Chinese', 'اليابانية' => 'Japanese', 'الروسية' => 'Russian',
                        'البرتغالية' => 'Portuguese', 'الإيطالية' => 'Italian', 'الهندية' => 'Hindi', 'الكورية' => 'Korean',
                        'التركية' => 'Turkish', 'الهولندية' => 'Dutch', 'السويدية' => 'Swedish', 'اليونانية' => 'Greek',
                        'العبرية' => 'Hebrew', 'البنغالية' => 'Bengali', 'البولندية' => 'Polish', 'الإندونيسية' => 'Indonesian',
                        'النرويجية' => 'Norwegian'
                    ] as $arabic => $english)
                        <option value="{{ $english }}" @if(in_array($english, explode(',', $applier->languages))) selected @endif>
                            {{ $arabic }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="address">عنوان السكن</label>
                <input type="text" id="address" name="address" required>
            </div>
            <div class="form-group">
                <label for="gender">الاسم الكامل</label>
                <select name="gender" id="gender">
                    <option value="male">ذكر</option>
                    <option value="female">أنثى</option>
                </select>
            </div>
            <div class="form-group">
                <label for="age">عنوان السكن</label>
                <input type="number" id="age" name="age" required>
            </div>
            <div class="form-group">
                <label for="cv">رفع السيرة الذاتية</label>
                <input type="file" id="cv" name="CVfile">
            </div>
            <div class="form-group">
                <label for="graduationDate">عنوان السكن</label>
                <input type="date" id="graduationDate" name="graduationDate" required>
            </div>

            <button type="submit">تحديث</button>
        </form>
    </div>
    @include('includes.footer')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/i18n/ar.js"></script>
    <script>


        $(document).ready(function() {

            $('.select2').select2({
                    placeholder: "اختر خيارًا",
                    allowClear: true,
                    width: '100%',
                    dir: "rtl",
                    language: "ar"
                });
                $('#specialization').change(function() {
                    if ($(this).val() === 'other') {
                        $('#customSpecializationDiv').show();
                    } else {
                        $('#customSpecializationDiv').hide();
                        $('#customSpecialization').val('');
                    }
                });
                $('#city').change(function() {
                    if ($(this).val() === 'أخرى') {
                        $('#customCityDiv').show();
                    } else {
                        $('#customCityDiv').hide();
                        $('#customCity').val('');
                    }
                });
                $('#languages').select2({
                    placeholder: "اختر اللغات",
                    allowClear: true,
                    width: '100%',
                    dir: "rtl",
                    language: "ar"
                });
        });

    </script>

</body>
</html>
