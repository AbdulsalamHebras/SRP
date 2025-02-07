<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller
{
    public function register(Request $request)
    {

        $request->validated();

        Company::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password), // Ensure password is hashed
            'commercialRegister' => $request->file('commercialRegister')->store('records', 'public'),
            'jobField' => $request->jobField,
            'mission' => $request->mission,
            'vision' => $request->vision,
            'dateOfCreation' => $request->dateOfCreation,
            'aboutus' => $request->aboutus,
            'logo' => $request->file('logo')->store('logos', 'public'),
            'phoneNumber' => $request->phoneNumber,
            'website' => $request->website,
        ]);

        return redirect()->route('company.new-company')->with('success', 'Company registered successfully!');
    }
    public function destroy(Request $request){
        Auth::guard('company')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

}