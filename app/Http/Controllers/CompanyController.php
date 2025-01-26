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
        $request->validate([
            'name' => 'required|string|max:255|unique:companies,name',
            'email' => 'required|email|unique:companies,email',
            'password' => 'required|confirmed|min:8',
            'commercialRegister' => 'required|file|mimes:jpeg,png,pdf|max:2048',
        ]);

        if ($request->hasFile('commercialRegister')) {
            $file = $request->file('commercialRegister');

            $originalFileName = $file->getClientOriginalName();

            $filePath = 'records/' . $originalFileName;

            Storage::disk('local')->put($filePath, file_get_contents($file));
        } else {
            return redirect()->back()->withErrors(['commercialRegister' => 'File upload failed.']);
        }

        $company = Company::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'commercialRegister' => $filePath,
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