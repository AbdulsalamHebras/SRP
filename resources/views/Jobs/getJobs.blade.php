

<div class="job-listing">
    @if($jobsNumber == 0)
        <p class="no-jobs"> لا توجد وظائف متاحة في الوقت الحالي .</p>
    @else
        @foreach ($jobs as $job)
        <div class="job-card">
            @if (!auth()->guard('company')->user())
                <div class="favorite" onclick="event.stopPropagation();">
                    <i class="heart-icon" onclick="toggleFavorite(this)">&#9829;</i>
                </div>
            @endif

            <a href="{{ route('jobs.details', $job->id) }}" class="job-card-link">
                <div class="job-info">
                    <h2 class="job-title">{{ $job->jobName }}</h2>
                    <div class="company">
                        <img src="{{ asset('storage/logos/' . $job->company->logo) }}" alt="Logo" class="logo">
                        <span>{{ $job->company->name }}</span>
                    </div>
                    <span class="location">{{ $job->location }}</span>
                    <p>{!! $job->description !!}</p>
                    <span class="salary">{{ $job->currency }}{{ $job->maxSalary }} - {{ $job->currency }}{{ $job->minSalary }}</span>
                    <span class="time-posted">
                        @if($job->updated_at > $job->created_at)
                            {{ $job->updated_at->locale('ar')->diffForHumans() }}
                        @else
                            {{ $job->created_at->locale('ar')->diffForHumans() }}
                        @endif
                    </span>
                </div>
            </a>

            @if (auth()->guard('company')->user())
                <div class="action-buttons">
                    <a href="{{ route('jobs.edit', $job->id) }}" class="btn-edit">
                        <button type="button">تعديل</button>
                    </a>
                    <form action="{{ route('jobs.destroy', $job->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-delete" onclick="return confirm('هل أنت متأكد أنك تريد حذف هذه الوظيفة؟')">حذف</button>
                    </form>
                </div>
            @else
                <div class="apply-btn">
                    <form action="{{ route('jobs.apply') }}" method="POST">
                        @csrf
                        <input type="hidden" name="job_id" value="{{ $job->id }}">
                        <button type="submit">التقديم السريع</button>
                    </form>
                </div>
            @endif
        </div>


        @endforeach
    @endif
</div>
<script>
    document.querySelectorAll('.apply-btn form').forEach(form => {
            form.addEventListener('submit', function(e) {
                console.log("🚀 تم الضغط على زر التقديم السريع");
            });
        });
</script>



