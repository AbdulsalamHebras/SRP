<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Job;
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

        $jobs = $query->get(); // Execute the query AFTER sorting
        $jobsNumber = $jobs->count();

        return view("Jobs.index", compact('jobs', 'jobsNumber', 'sort'));
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