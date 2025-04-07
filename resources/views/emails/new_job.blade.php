<html>
<head>
    <title>تم نشر وظيفة جديدة</title>
</head>
<body>
    <h2>تم نشر وظيفة جديدة على الموقع</h2>
    <p>اسم الوظيفة: {{ $job->jobName }}</p>
    <p>الشركة: {{ $company->name }}</p>
    <p>نوع الوظيفة: {{ $job->jobType }}</p>
    <p>الحد الأدنى للراتب: {{ $job->minSalary }} {{ $job->currency }}</p>
    <p>الحد الأقصى للراتب: {{ $job->maxSalary }} {{ $job->currency }}</p>
    <p>الموقع: {{ $job->location }}</p>
    <p>لمعرفة المزيد عن الوظيفة، الرجاء الضغط على الرابط أدناه.</p>
    <p><a href="{{route('jobs.details',$job->id)}}">عرض التفاصيل</a></p>
</body>
</html>
