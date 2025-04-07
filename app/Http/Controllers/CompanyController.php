<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyRequest;
use App\Models\Company_follower;
use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Job;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use App\Models\jobs_appliers;
use App\Mail\CompanyRegistered;
use Illuminate\Support\Facades\Mail;

class CompanyController extends Controller
{
    public function index(){
        $companies = Company::where('isAccepted', true)->get();
        return view("companies.index", compact('companies'));
    }
    public function edit($id){
        $company=Company::where('id',$id)->first();
        return view('companies.edit',compact('company'));
    }
    public function update(Request $request, $id){
        $company = Company::findOrFail($id);
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:companies,name,'.$id],
        'email' => ['required', 'email', 'unique:companies,email,'.$id],
        'password' => [
                'nullable',
                'confirmed',
                Password::defaults(),
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/'
            ],
        'commercialRegister' => ['nullable', 'file', 'mimes:jpeg,png,pdf', 'max:10240'],
        'jobField' => ['required', 'string', 'max:255'],
        'location' => ['required', 'string', 'max:255'],
        'mission' => ['required', 'string'],
        'vision' => ['required', 'string'],
        'dateOfCreation' => ['required', 'date', 'before:today'], // Ensures the date is before today
        'aboutus' => ['required', 'string'],
        'logo' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:5120'],
        'phoneNumber' => [
            'required',
            'numeric',
            'digits:9',
            'regex:/^(77|78|71|73|70)\d{7}$/',
            'unique:companies,phoneNumber,'.$id
        ],
        'website' => ['required', 'url','unique:companies,website,'.$id],
        ]);
        $logoName = $company->logo;
        $recordName = $company->commercialRegister;
        if ($request->hasFile('logo')) {
            if ($company->logo) {
                \Storage::disk('public')->delete('logos/' . $company->logo);
            }

            $logo = $request->file('logo');
            $logoName = $logo->getClientOriginalExtension();
            $logo->storeAs('logos', $logoName, 'public');

        }
        if ($request->hasFile('commercialRegister')) {
            if ($company->commercialRegister) {
                \Storage::disk('public')->delete('records/' . $company->commercialRegister);
            }

            $record = $request->file('commercialRegister');
            $recordName = $record->getClientOriginalExtension();
            $record->storeAs('records', $recordName, 'public');
        }
        $company->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phoneNumber' => $validated['phoneNumber'],
            'website' => $validated['website'],
            'jobField' => $validated['jobField'],
            'location' => $validated['location'],
            'mission' => $validated['mission'],
            'vision' => $validated['vision'],
            'logo'=>$logoName,
            'commercialRegister'=>$recordName,
            'dateOfCreation' => $validated['dateOfCreation'],
            'aboutus' => $validated['aboutus'],
        ]);

        if ($request->filled('password')) {
            $company->update([
                'password' => Hash::make($validated['password']),
            ]);
        }
        return redirect()->route('company.dashboard')->with('success', 'تم تحديث بيانات الشركة بنجاح!');

    }
    public function details($id){
        $company = Company::with('jobs')->where('id', $id)->first();
        return view('companies.details',compact('company'));
    }
    public function jobs(Request $request) {
        $sort = $request->input('sort', 'date');

        $company = Company::find(auth()->guard('company')->user()->id);

        if (!$company) {
            abort(404, 'الشركة غير موجودة');
        }

        $jobs = Job::where('company_id', auth()->guard('company')->user()->id);

        if ($sort === 'date') {
            $jobs->orderBy('created_at', 'desc');
        } elseif ($sort === 'type') {
            $jobs->orderBy('jobType', 'asc');
        } elseif ($sort === 'maxsalary') {
            $jobs->orderBy('maxSalary', 'desc');
        }

        $jobs = $jobs->get();
        $jobsNumber = $jobs->count();

        return view('companies.jobs', compact('jobs', 'jobsNumber', 'sort'));
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
        if($company){
            Mail::to('wesamdreib2@gmail.com')->send(new CompanyRegistered($company));
        }

        return redirect()->route('companies.new-company')->with('success', 'Company registered successfully!');
    }
    public function follow(Request $request, $id)
    {

        $user = auth()->user();

        if (!$user) {
            return redirect()->back()->with('status', 'error')->with('message', 'يجب عليك تسجيل الدخول أولاً.');
        }

        $company = Company::findOrFail($id);

        if ($user->followedCompanies()->where('company_id', $id)->exists()) {
            $user->followedCompanies()->detach($id);
            return redirect()->back()->with('status', 'unfollowed')->with('message', 'تم إلغاء متابعة الشركة بنجاح.');
        } else {
            $user->followedCompanies()->attach($id);
            return redirect()->back()->with('status', 'followed')->with('message', 'تمت متابعة الشركة بنجاح.');
        }
    }

    public function destroy(Request $request){
        Auth::guard('company')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
    public function appliers(Request $request)
    {
        $company = auth()->guard('company')->user();

        if (!$company) {
            return redirect()->route('company.login')->with('error', 'يجب تسجيل الدخول كمؤسسة.');
        }

        $jobs = $company->jobs()->with('appliers')->get();

        $appliers = \App\Models\Applier::whereHas('jobs', function ($query) use ($company) {
            $query->whereIn('jobs.id', $company->jobs()->pluck('id'));
        })->with(['jobs' => function ($query) use ($company) {
            $query->whereIn('jobs.id', $company->jobs()->pluck('id'));
        }])->get();



        return view('companies.appliers', compact('jobs', 'appliers'));
    }





}
