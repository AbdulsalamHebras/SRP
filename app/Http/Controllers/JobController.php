<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index(){
        return view("Jobs.index");
    }
    public function details(){
        return view('Jobs.details');
    }
    public function apply(){
        //
    }
}