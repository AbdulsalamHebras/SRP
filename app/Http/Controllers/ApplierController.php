<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Applier;

class ApplierController extends Controller
{
    public function userAppliments(){
        $user = auth()->guard('web')->user();
        $applier = Applier::where('email', $user->email)->first();

        return view("main", compact( "applier"));

    }
    public function updateCV(Request $request){
        $user = auth()->guard('web')->user();
        $applier = Applier::where('email', $user->email)->first();

        return view("CV.update", compact( "applier"));
    }
    public function seeCV(){
        $user = auth()->guard('web')->user();
        $applier = Applier::where('email', $user->email)->first();

        return view("CV.details", compact( "applier"));
    }
}
