<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyRequest;
use Illuminate\Http\Request;
use App\Models\Company;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller
{
    public function index(){
        $companies=Company::all();
        return view("companies.index", compact('companies'));
    }
    public function details($id){
        $company = Company::with('jobs')->where('id', $id)->first();
        return view('companies.details',compact('company'));
    }
    public function register(CompanyRequest $request)
    {
        $validated = $request->validated();

        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $logoName = $logo->getClientOriginalName();
            $logo->storeAs('logos', $logoName, 'public');  // Store logo in the 'public' directory
        } else {
            return back()->withErrors(['logo' => 'Logo is required.']);
        }

        if ($request->hasFile('commercialRegister')) {
            $record = $request->file('commercialRegister');
            $recordName = $record->getClientOriginalName(); // Add timestamp to avoid duplicates
            $record->storeAs('records', $recordName, 'public'); // Store commercial register in the 'public' directory
        } else {
            return back()->withErrors(['commercialRegister' => 'Commercial register is required.']);
        }
        $company = Company::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password), // Ensure password is hashed
            'jobField' => $request->jobField,
            'location' => $request->location,
            'mission' => $request->mission,
            'vision' => $request->vision,
            'dateOfCreation' => $request->dateOfCreation,
            'aboutus' => $request->aboutus,
            'phoneNumber' => $request->phoneNumber,
            'website' => $request->website,
            'logo' => $logoName, // Save the logo name
            'commercialRegister' => $recordName, // Save the record name
        ]);

        return redirect()->route('companies.new-company')->with('success', 'Company registered successfully!');
    }



    public function destroy(Request $request){
        Auth::guard('company')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

}