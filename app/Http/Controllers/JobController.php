<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index(Request $request){
        $sort = $request->input('sort');
        $query = Job::query();

        if ($sort == 'date') {
            $query->orderBy('created_at', 'desc');
        } elseif ($sort == 'type') {
            $query->orderBy('jobType', 'asc');
        } elseif ($sort == 'salary') {
            $query->orderBy('maxSalary', 'desc');
        }
        $jobs = Job::with('company')->get();
        return view("Jobs.index", compact('jobs'));
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