<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Applier;

class MainPageController extends Controller
{
    public function main()
    {
        $user = auth()->guard('web')->user();

        $applier = Applier::where('email', $user->email)->first();
        $appliedJobs = $applier ? $applier->Jobs()->count() : 0;

        return view("main", compact( "applier",'appliedJobs'));
    }

}
