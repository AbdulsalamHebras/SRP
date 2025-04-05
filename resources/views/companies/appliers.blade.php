<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>المتقدمون</title>
    <link rel="stylesheet" href="{{ asset('CSS/companies/appliers.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    @include('includes.header')
    @if (session('success'))
    <div class="custom-alert success">
        {{ session('success') }}
        <span class="close-btn" onclick="this.parentElement.remove();">&times;</span>
    </div>
    @endif

    @if (session('error'))
        <div class="custom-alert error">
            {{ session('error') }}
            <span class="close-btn" onclick="this.parentElement.remove();">&times;</span>
        </div>
    @endif

    <div class="container">
        <h2>المتقدمون على وظائف شركتك</h2>

        @if($appliers->isEmpty())
            <p>لا يوجد متقدمون حتى الآن.</p>
        @else
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>الاسم</th>
                        <th>البريد الإلكتروني</th>
                        <th>السيرة الذاتية</th>
                        <th>الصورة</th>
                        <th>الوظيفة المتقدم لها</th>
                        <th>الإجراء</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($appliers as $applier)
                        @foreach ($applier->jobs as $job)
                            @php
                                $rowId = "details-{$applier->id}-{$job->id}";
                                $modalId = "modal-{$applier->id}-{$job->id}";
                                $editModalId = "edit-modal-{$applier->id}-{$job->id}";

                                // البحث عن مقابلة مجدولة مسبقًا
                                $existingInterview = \App\Models\Interview::where('applier_id', $applier->id)
                                                                            ->where('job_id', $job->id)
                                                                            ->first();
                            @endphp
                            <tr>
                                <td>{{ $applier->name }}</td>
                                <td>{{ $applier->email }}</td>
                                <td><a href="{{ asset('storage/cv_files/' . $applier->CVfile) }}" target="_blank">تحميل السيرة الذاتية</a></td>
                                <td><img src="{{ asset('storage/photos/' . $applier->photo) }}" alt="الصورة" style="width: 40px; height: 40px; border-radius: 50%;"></td>
                                <td>{{ $job->jobName }}</td>
                                <td>
                                    @if($existingInterview)
                                        <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#{{ $editModalId }}">تغيير الموعد</button>
                                        <p><strong>الموعد السابق:</strong> {{ $existingInterview->date }} - {{ $existingInterview->time }}</p>
                                    @else
                                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#{{ $modalId }}">دعوة للمقابلة</button>
                                    @endif
                                </td>
                                <td>
                                    <button class="btn btn-info toggle-details" data-target="{{ $rowId }}">إظهار التفاصيل</button>
                                </td>
                            </tr>

                            <tr id="{{ $rowId }}" class="details-row" style="display: none;">
                                <td colspan="7">
                                    <p><strong>رقم الهاتف:</strong> {{ $applier->phoneNumber }}</p>
                                    <p><strong>المدينة:</strong> {{ $applier->city }}</p>
                                    <p><strong>العنوان:</strong> {{ $applier->address }}</p>
                                    <p><strong>تاريخ الميلاد:</strong> {{ $applier->DOB }}</p>
                                    <p><strong>الجنس:</strong> {{ $applier->gender }}</p>
                                    <p><strong>المؤهل الدراسي:</strong> {{ $applier->degree }}</p>
                                    <p><strong>التخصص:</strong> {{ $applier->specialization }}</p>
                                    <p><strong>اللغات:</strong> {{ $applier->languages }}</p>
                                    <p><strong>تاريخ التخرج:</strong> {{ $applier->graduationDate }}</p>
                                    <p><strong>العمر:</strong> {{ $applier->age }}</p>
                                </td>
                            </tr>

                            <!-- نموذج دعوة مقابلة جديدة -->
                            <div class="modal fade" id="{{ $modalId }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">تحديد موعد المقابلة</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('interviews.schedule') }}" method="POST">
                                            @csrf
                                            <div class="modal-body">
                                                <input type="hidden" name="applier_id" value="{{ $applier->id }}">
                                                <input type="hidden" name="job_id" value="{{ $job->id }}">
                                                <div class="mb-3">
                                                    <label for="date" class="form-label">تاريخ المقابلة</label>
                                                    <input type="date" class="form-control @error('date') is-invalid @enderror" name="date" required >
                                                    @error('date')
                                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label for="time" class="form-label">وقت المقابلة</label>
                                                    <input type="time" class="form-control @error('time') is-invalid @enderror" name="time" required>
                                                    @error('time')
                                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label for="notes" class="form-label">ملاحظات (اختياري)</label>
                                                    <textarea class="form-control @error('notes') is-invalid @enderror" name="notes" rows="3"></textarea>
                                                    @error('notes')
                                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                                                <button type="submit" class="btn btn-success">إرسال الدعوة</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- نموذج تعديل الموعد إذا كانت المقابلة موجودة -->
                            @if($existingInterview)
                                <div class="modal fade" id="{{ $editModalId }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">تعديل موعد المقابلة</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('interviews.update', $existingInterview->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label for="date" class="form-label">تاريخ المقابلة الجديد</label>
                                                        <input type="date" class="form-control @error('date') is-invalid @enderror" name="date" value="{{ $existingInterview->date }}" required>
                                                        @error('date')
                                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="time" class="form-label">وقت المقابلة الجديد</label>
                                                        <input type="time" class="form-control @error('time') is-invalid @enderror" name="time" value="{{ $existingInterview->time }}" required>
                                                        @error('time')
                                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="notes" class="form-label">ملاحظات (اختياري)</label>
                                                        <textarea class="form-control @error('notes') is-invalid @enderror" name="notes" rows="3">{{ $existingInterview->notes }}</textarea>
                                                        @error('notes')
                                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                                                    <button type="submit" class="btn btn-warning">حفظ التعديلات</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endif

                        @endforeach
                    @endforeach
                </tbody>

            </table>
        @endif
    </div>

    @include('includes.footer')

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            document.querySelectorAll('.toggle-details').forEach(button => {
                button.addEventListener('click', function () {
                    let targetId = this.getAttribute('data-target');
                    let detailsRow = document.getElementById(targetId);

                    document.querySelectorAll('.details-row').forEach(row => {
                        if (row.id !== targetId) {
                            row.style.display = "none";
                        }
                    });

                    if (detailsRow.style.display === "none" || detailsRow.style.display === "") {
                        detailsRow.style.display = "table-row";
                        this.textContent = "إخفاء التفاصيل";
                    } else {
                        detailsRow.style.display = "none";
                        this.textContent = "إظهار التفاصيل";
                    }
                });
            });
        });
        setTimeout(function() {
        document.querySelectorAll('.custom-alert').forEach(alert => {
            alert.style.opacity = "0";
            alert.style.transform = "translateY(-20px)";
            setTimeout(() => alert.remove(), 500);
        });
    }, 5000);
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
