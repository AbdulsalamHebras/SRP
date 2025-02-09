<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index(){
        $jobs = Job::with('company')->get();
        return view("Jobs.index", compact('jobs'));
    }
    public function details(){
        return view('Jobs.details');
    }
    public function apply(){
        //
    }
}