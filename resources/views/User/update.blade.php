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
        <form action="{{route('user.updateCV',['applier' => $applier->id])}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <!-- Photo -->
            <div class="form-group">
                <label for="photo">رفع الصورة الشخصية</label>
                <input type="file" name="photo" id="photo" class="form-control @error('photo') is-invalid @enderror">
                @error('photo') <span class="invalid-feedback"><strong>{{ $message }}</strong></span> @enderror
            </div>

            <!-- Name -->
            <div class="form-group">
                <label for="name">الاسم الكامل</label>
                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $applier->name) }}" required>
                @error('name') <span class="invalid-feedback"><strong>{{ $message }}</strong></span> @enderror
            </div>

            <!-- Email -->
            <div class="form-group">
                <label for="email">البريد الإلكتروني</label>
                <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $applier->email) }}" required>
                @error('email') <span class="invalid-feedback"><strong>{{ $message }}</strong></span> @enderror
            </div>

            <!-- Password -->
            <div class="form-group">
                <label for="password">كلمة المرور</label>
                <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror">
                @error('password') <span class="invalid-feedback"><strong>{{ $message }}</strong></span> @enderror
            </div>

            <!-- Phone -->
            <div class="form-group">
                <label for="phone">رقم الهاتف</label>
                <input type="text" name="phoneNumber" id="phone" class="form-control @error('phoneNumber') is-invalid @enderror" value="{{ old('phoneNumber', $applier->phoneNumber) }}" required>
                @error('phoneNumber') <span class="invalid-feedback"><strong>{{ $message }}</strong></span> @enderror
            </div>
             <!-- Date of Birth (DOB) -->
             <div class="form-group">
                <label for="DOB">تاريخ الميلاد</label>
                <input type="date" name="DOB" id="DOB" class="form-control @error('DOB') is-invalid @enderror" value="{{ old('DOB', $applier->DOB) }}" >
                @error('DOB') <span class="invalid-feedback"><strong>{{ $message }}</strong></span> @enderror
            </div>

            <!-- Age (Dynamic, calculated from DOB) -->
            <div class="form-group">
                <label for="age">العمر</label>
                <input type="text" name="age" id="age" class="form-control @error('age') is-invalid @enderror" value="{{ old('age', $applier->age) }}" readonly required>
                @error('age') <span class="invalid-feedback"><strong>{{ $message }}</strong></span> @enderror
            </div>

            <!-- City -->
            <div class="form-group">
                <label for="city">المدينة</label>
                <select name="city" id="city" class="form-control select2 @error('city') is-invalid @enderror">
                    <option value="">اختر المدينة</option>
                    @foreach(['صنعاء', 'عدن', 'تعز', 'الحديدة', 'المكلا', 'إب', 'الضالع', 'ذمار', 'حجة', 'عمران', 'لحج', 'المحويت', 'البيضاء', 'شبوة', 'الجوف', 'صعدة', 'ريمة', 'حضرموت', 'مأرب', 'المهرة', 'سقطرى'] as $city)
                        <option value="{{ $city }}" {{ old('city', $applier->city) == $city ? 'selected' : '' }}>{{ $city }}</option>
                    @endforeach
                </select>
                @error('city') <span class="invalid-feedback"><strong>{{ $message }}</strong></span> @enderror
            </div>

            <!-- Address -->
            <div class="form-group">
                <label for="address">عنوان السكن</label>
                <input type="text" name="address" id="address" class="form-control @error('address') is-invalid @enderror" value="{{ old('address', $applier->address) }}" required>
                @error('address') <span class="invalid-feedback"><strong>{{ $message }}</strong></span> @enderror
            </div>


            <div class="form-group">
                <label for="BOB">المؤهل العلمي</label>
                <select name="degree" id="degree" class="form-control select2 @error('degree') is-invalid @enderror">
                    <option value="">اختر المؤهل العلمي</option>
                    @foreach(['دبلوم', 'بكالوريوس', 'ماجستير', 'دكتوراه', 'أخرى'] as $degree)
                        <option value="{{ $degree }}" {{ old('degree', $applier->degree) == $degree ? 'selected' : '' }}>{{ $degree }}</option>
                    @endforeach
                </select>
                @error('degree') <span class="invalid-feedback"><strong>{{ $message }}</strong></span> @enderror
            </div>

            <!-- Gender -->
            <div class="form-group">
                <label for="gender">الجنس</label>
                <select name="gender" id="gender" class="form-control @error('gender') is-invalid @enderror" required>
                    <option value="male" {{ old('gender', $applier->gender) == 'male' ? 'selected' : '' }}>ذكر</option>
                    <option value="female" {{ old('gender', $applier->gender) == 'female' ? 'selected' : '' }}>أنثى</option>
                </select>
                @error('gender') <span class="invalid-feedback"><strong>{{ $message }}</strong></span> @enderror
            </div>

            <!-- Specialization -->
            <div class="form-group">
                <label for="specialization">التخصص</label>
                <select name="specialization" id="specialization" class="form-control select2 @error('specialization') is-invalid @enderror">
                    <option value="">اختر التخصص</option>
                    @foreach([
                        'علوم الحاسوب', 'الذكاء الاصطناعي', 'الأمن السيبراني', 'تحليل البيانات', 'هندسة البرمجيات', 'الروبوتات',
                        'الهندسة الكهربائية', 'الهندسة الميكانيكية', 'الهندسة الطبية الحيوية', 'الهندسة المدنية', 'الهندسة الكيميائية',
                        'الفيزياء التطبيقية', 'علوم الأحياء', 'الطب والجراحة', 'الصيدلة', 'التغذية وعلم الغذاء', 'الاقتصاد',
                        'إدارة الأعمال', 'التسويق الرقمي', 'المحاسبة', 'القانون والتشريعات', 'العلاقات الدولية', 'الإعلام والاتصال',
                        'التصميم الجرافيكي', 'تصميم تجربة المستخدم (UX/UI)', 'الواقع الافتراضي والواقع المعزز', 'الطاقة المتجددة',
                        'إدارة المشاريع', 'علم النفس', 'التربية والتعليم', 'اللغويات والترجمة', 'علوم الفضاء والفلك'
                    ] as $specialization)
                        <option value="{{ $specialization }}" {{ old('specialization', $applier->specialization) == $specialization ? 'selected' : '' }}>{{ $specialization }}</option>
                    @endforeach
                    <option value="other" {{ old('specialization', $applier->specialization) == 'other' ? 'selected' : '' }}>أخرى</option>
                </select>
                @error('specialization') <span class="invalid-feedback"><strong>{{ $message }}</strong></span> @enderror
            </div>

            <!-- Languages -->
            <div class="form-group">
                <label for="languages">اللغات:</label>
                <select name="languages[]" id="languages" multiple class="form-control @error('languages') is-invalid @enderror">
                    @foreach(['الإنجليزية' => 'English', 'العربية' => 'Arabic', 'الفرنسية' => 'French', 'الإسبانية' => 'Spanish',
                              'الألمانية' => 'German', 'الصينية' => 'Chinese', 'اليابانية' => 'Japanese', 'الروسية' => 'Russian',
                              'البرتغالية' => 'Portuguese', 'الإيطالية' => 'Italian', 'الهندية' => 'Hindi', 'الكورية' => 'Korean',
                              'التركية' => 'Turkish', 'الهولندية' => 'Dutch', 'السويدية' => 'Swedish', 'اليونانية' => 'Greek',
                              'العبرية' => 'Hebrew', 'البنغالية' => 'Bengali', 'البولندية' => 'Polish', 'الإندونيسية' => 'Indonesian',
                              'النرويجية' => 'Norwegian'] as $arabic => $english)
                        <option value="{{ $english }}" @if(in_array($english, (array) old('languages', explode(',', $applier->languages)))) selected @endif>
                            {{ $arabic }}
                        </option>
                    @endforeach
                </select>
                @error('languages') <span class="invalid-feedback"><strong>{{ $message }}</strong></span> @enderror
            </div>


            <!-- CV file -->
            <div class="form-group">
                <label for="cv">رفع السيرة الذاتية</label>
                <input type="file" name="CVfile" id="cv" class="form-control @error('CVfile') is-invalid @enderror">
                @error('CVfile') <span class="invalid-feedback"><strong>{{ $message }}</strong></span> @enderror
            </div>

            <!-- Graduation Date -->
            <div class="form-group">
                <label for="graduationDate">تاريخ التخرج</label>
                <input type="date" name="graduationDate" id="graduationDate" class="form-control @error('graduationDate') is-invalid @enderror" value="{{ old('graduationDate', $applier->graduationDate) }}" >
                @error('graduationDate') <span class="invalid-feedback"><strong>{{ $message }}</strong></span> @enderror
            </div>



            <button type="submit" class="btn btn-primary">تحديث</button>
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

            $('#languages').select2({
                placeholder: "اختر اللغات",
                allowClear: true,
                width: '100%',
                dir: "rtl",
                language: "ar"
            });
            $('#DOB').on('change', function() {
                var DOB = new Date($(this).val());
                var today = new Date();
                var age = today.getFullYear() - DOB.getFullYear();
                var m = today.getMonth() - DOB.getMonth();
                if (m < 0 || (m === 0 && today.getDate() < DOB.getDate())) {
                    age--;
                }
                $('#age').val(age);
            });
        });
    </script>

</body>
</html>
