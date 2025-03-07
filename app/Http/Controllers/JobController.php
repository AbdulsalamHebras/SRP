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
    public function store(JobRequest $request) {
        $validated = $request->validated();
        $job = Job::create([
            'jobName'        => $request->input('jobName'),
            'jobType'        => $request->input('jobType'),
            'description'    => $request->input('description'),
            'minSalary'      => $request->input('minSalary'),
            'maxSalary'      => $request->input('maxSalary'),
            'currency'       => $request->input('currency'),
            'expirationDate' => $request->input('expirationDate'),
            'requirements'   => $request->input('requirements'),
            'location'       => $request->input('location'),
            'company_id'     => auth()->guard('company')->user()->id,
        ]);
        $company = auth()->guard('company')->user();
        $company->increment('jobsNumber');

        return redirect()->route('company.jobs')->with('success','the job added succesfully');

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
