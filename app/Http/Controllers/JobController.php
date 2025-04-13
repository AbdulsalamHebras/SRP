<?php

namespace App\Http\Controllers;

use App\Http\Requests\JobRequest;
use App\Models\Company;
use App\Models\Job;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\jobs_appliers;
use Illuminate\Support\Facades\Auth;
use App\Models\Applier;
use App\Mail\NewJobPosted;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

class JobController extends Controller
{
    private $sort;
    public function index(Request $request)
        {
            $user = Auth::user();
            $specialization = $user->applier->specialization ?? null;

            $sort = $request->input('sort', $specialization ? 'similarity' : 'date');

            $query = Job::with('company')
                ->where('expirationDate', '>=', now());

            if ($sort === 'date') {
                $query->orderBy('created_at', 'desc');
            } elseif ($sort === 'type') {
                $query->orderBy('jobType', 'asc');
            } elseif ($sort === 'salary') {
                $query->orderBy('maxSalary', 'desc');
            }


            $jobs = $query->get();
            $jobsNumber = $jobs->count();

            if ($sort === 'similarity' && $specialization) {
                $response = Http::timeout(10)
                    ->withHeaders([
                        'Authorization' => 'Bearer ' . env('HUGGINGFACE_API_KEY'),
                    ])->post('https://api-inference.huggingface.co/models/sentence-transformers/paraphrase-multilingual-MiniLM-L12-v2', [
                        'inputs' => [
                            'source_sentence' => $specialization,
                            'sentences' => $jobs->pluck('description')->toArray(),
                        ],
                    ]);

                if ($response->ok()) {
                    $scores = $response->json();


                    $jobs = $jobs->sortByDesc(function ($job, $index) use ($scores) {
                        return $scores[$index] ?? 0;
                    })->values();
                }
            }

            return view("Jobs.index", compact('jobs', 'jobsNumber', 'sort'));
        }


    public function create() {

        return view('jobs.add');
    }
    public function store(JobRequest $request)
    {


        $validated = $request->validated();

        $location = $request->jobType === 'عن بعد' ? 'عن بعد' : $request->location;

        $job = Job::create([
            'jobName'        => $request->jobName,
            'jobType'        => $request->jobType,
            'description'    => $request->description,
            'minSalary'      => $request->minSalary,
            'maxSalary'      => $request->maxSalary,
            'currency'       => $request->currency,
            'expirationDate' => $request->expirationDate,
            'requirements'   => $request->requirements,
            'location'       => $location,
            'company_id'     => auth()->guard('company')->user()->id,
        ]);

        $company = auth()->guard('company')->user();
        $company->update(['jobsNumber' => $company->jobsNumber + 1]);
        if($job){
            $followers = $company->followers;

            foreach ($followers as $follower) {
                Mail::to($follower->email)->send(new NewJobPosted($job, $company));
            }
        }

            return redirect()->route('company.jobs')->with('success', 'The job added successfully');
    }


    public function details(string $id){
        $job = Job::with('company')->where('id', $id)->first();


        if (!$job) {
            abort(404);
        }

        return view('Jobs.details', compact('job'));
    }
    public function edit($id)
    {
        $job = Job::findOrFail($id);

        if (auth()->guard('company')->user()->id != $job->company_id) {
            return redirect()->route('jobs.index')->with('error', 'ليس لديك صلاحية لتعديل هذه الوظيفة.');
        }

        return view('jobs.edit', compact('job'));
    }
    public function update(JobRequest $request, $id){
        $job = Job::findOrFail($id);

        if (auth()->guard('company')->user()->id != $job->company_id) {
            return redirect()->route('company.jobs')->with('error', 'ليس لديك صلاحية لتعديل هذه الوظيفة.');
        }

        $validated = $request->validated();

        $location = $request->jobType === 'عن بعد' ? 'عن بعد' : $request->location;

        $job->update([
            'jobName'        => $request->jobName,
            'jobType'        => $request->jobType,
            'description'    => $request->description,
            'minSalary'      => $request->minSalary,
            'maxSalary'      => $request->maxSalary,
            'currency'       => $request->currency,
            'expirationDate' => $request->expirationDate,
            'requirements'   => $request->requirements,
            'location'       => $location,
        ]);

        return redirect()->route('company.jobs')->with('success', 'تم تحديث الوظيفة بنجاح.');
    }


    public function destroy($id)
    {
        $job = Job::findOrFail($id);

        if (auth()->guard('company')->user()->id != $job->company_id) {
            return redirect()->route('company.jobs')->with('error', 'ليس لديك صلاحية لحذف هذه الوظيفة.');
        }

        $job->delete();

        return redirect()->route('company.jobs')->with('success', 'تم حذف الوظيفة بنجاح.');
    }

    public function apply(Request $request) {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'يجب تسجيل الدخول قبل التقديم.');
        }

        $user = Auth::user();
        $jobId = $request->input('job_id');

        $applier = Applier::where('email', $user->email)->first();

        if (!$applier) {
            return back()->with('error', 'لم يتم العثور على حساب مقدم طلب مطابق.');
        }

        if (jobs_appliers::where('applier_id', $applier->id)->where('job_id', $jobId)->exists()) {
            return back()->with('error', 'لقد قمت بالتقديم مسبقًا على هذه الوظيفة.');
        }

        $jobApplier = jobs_appliers::create([
            'applier_id' => $applier->id,
            'job_id' => $jobId,
        ]);

        if ($jobApplier) {
            Job::where('id', $jobId)->increment('reqGrade');
        }

        return back()->with('success', 'تم التقديم بنجاح!');
    }


    public function search(Request $request) {
        $query = Job::with('company')
            ->where('expirationDate', '>=', now()); // Filter expired jobs

        // إذا كانت هناك شركة مسجلة دخول، نعرض وظائفها فقط
        if (auth('company')->check()) {
            $companyId = auth('company')->id();
            $query->where('company_id', $companyId);
        }

        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('jobName', 'LIKE', "%{$search}%")
                  ->orWhere('description', 'LIKE', "%{$search}%");
            });
        }

        if ($request->has('location') && !empty($request->location) && $request->location !== 'جميع المواقع') {
            $query->where('location', $request->location);
        }

        $jobs = $query->paginate(10);
        $jobsNumber = $jobs->total();

        return view('jobs.index', compact('jobs', 'jobsNumber'))->with('sort');
    }



}
