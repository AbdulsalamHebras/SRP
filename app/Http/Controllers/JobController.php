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
    public function apply(){
        //
    }
}
