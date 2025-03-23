<?php

namespace App\Http\Controllers;
use App\Http\Requests\ApplierRequest;
use Illuminate\Http\Request;
use App\Models\Applier;
use Illuminate\Support\Facades\Storage;

class ApplierController extends Controller
{
    public function userAppliments(){
        $user = auth()->guard('web')->user();
        $applier = Applier::where('email', $user->email)->first();
        $jobs = $applier->jobs;  

        return view("User.jobs", compact("applier", "jobs"));
    }
    public function editCV(Request $request){
        $user = auth()->guard('web')->user();
        $applier = Applier::where('email', $user->email)->first();

        return view("User.update", compact( "applier"));
    }

    public function updateCV(ApplierRequest $request, Applier $applier)
    {
        $data = $request->except(['photo', 'CVfile', 'password']);

        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        }

        if ($request->has('languages')) {
            $data['languages'] = is_array($request->languages) ? implode(',', $request->languages) : $request->languages;
        }

        if ($request->hasFile('photo')) {
            $photoName = $request->file('photo')->getClientOriginalName();

            if ($applier->photo && Storage::disk('public')->exists("photos/{$applier->photo}")) {
                Storage::disk('public')->delete("photos/{$applier->photo}");
            }

            $request->file('photo')->storeAs('photos', $photoName, 'public');
            $data['photo'] = $photoName;
        }

        if ($request->hasFile('CVfile')) {
            $cvName = $request->file('CVfile')->getClientOriginalName();

            if ($applier->CVfile && Storage::disk('public')->exists("cv_files/{$applier->CVfile}")) {
                Storage::disk('public')->delete("cv_files/{$applier->CVfile}");
            }

            $request->file('CVfile')->storeAs('cv_files', $cvName, 'public');
            $data['CVfile'] = $cvName;
        }

        $applier->update($data);
        return redirect()->route('main')->with('success', 'تم تحديث المعلومات بنجاح!');

    }



    public function seeCV(){
        $user = auth()->guard('web')->user();
        $applier = Applier::where('email', $user->email)->first();

        return view("CV.details", compact( "applier"));
    }
}
