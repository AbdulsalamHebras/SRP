<?php

namespace App\Http\Controllers;

use App\Http\Requests\JobRequest;
use App\Models\Company;
use App\Models\Job;
use App\Models\Category;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index(Request $request) {
        $sort = $request->input('sort', 'date');

        $query = Job::with('company');

        if ($sort === 'date') {
            $query->orderBy('created_at', 'desc');
        } elseif ($sort === 'type') {
            $query->orderBy('jobType', 'asc');
        } elseif ($sort === 'salary') {
            $query->orderBy('maxSalary', 'desc');
        }

        $jobs = $query->get();
        $jobsNumber = $jobs->count();

        return view("Jobs.index", compact('jobs', 'jobsNumber', 'sort'));
    }
    public function create() {

        return view('jobs.add');
    }
    public function store(JobRequest $request)
    {
        dd($request->all());

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

    // Increment the jobsNumber for the company
    $company = auth()->guard('company')->user();
        $company->update(['jobsNumber' => $company->jobsNumber + 1]);

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

    public function apply(){
        //
    }
    public function search(Request $request) {
        $query = Job::with('company');

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

        return view('jobs.index', compact('jobs', 'jobsNumber'));
    }

}
