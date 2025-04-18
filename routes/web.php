<?php

use App\Http\Controllers\ApplierController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\MainPageController;
use App\Http\Controllers\InterviewController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisteredUserController;
use Illuminate\Support\Facades\Route;
use App\Models\Job;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Company;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', function () {
    if (auth()->guard('company')->user())
        {
            $company = Company::find(auth()->guard('company')->user()->id);

            if (!$company) {
                abort(404, 'الشركة غير موجودة');
            }

            $jobs = Job::where('company_id', auth()->guard('company')->user()->id);
            $jobs = $jobs->latest()->take(6)->get();
        }
    else{
        $jobs = Job::with('company')
            ->where('expirationDate', '>=', Carbon::now())
            ->latest()
            ->take(6)
            ->get();
    }
    return view('index',compact('jobs'));
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth:web')->get('/main', [MainPageController::class,'main'])->name('main');


Route::name('jobs.')->group(function () {
    Route::get('/jobs', [JobController::class, 'index'])->name('index');
    Route::get('/jobs/search', [JobController::class, 'search'])->name('search');
    Route::middleware('auth:company')->get('/jobs/add', [JobController::class, 'create'])->name('add');
    Route::middleware('auth:company')->post('/jobs/add', [JobController::class, 'store'])->name('add');
    Route::get('/job-details/{jobid}', [JobController::class, 'details'])->name('details');
    Route::middleware('auth:company')->get('/job-edit/{jobid}', [JobController::class, 'edit'])->name('edit');
    Route::middleware('auth:company')->post('/job-edit/{jobid}', [JobController::class, 'update'])->name('update');
    Route::middleware('auth:company')->delete('/job-delete/{jobid}', [JobController::class, 'destroy'])->name('destroy');
    Route::post('/job-apply', [JobController::class, 'apply'])->name('apply')->middleware('auth');
});

Route::name('companies.')->prefix('companies')->group(function () {
    Route::get('/', [CompanyController::class, 'index'])->name('index');
    Route::get('/companies/search', [CompanyController::class, 'search'])->name('search');
    Route::get('/details/{companyid}', [CompanyController::class, 'details'])->name('details');
    Route::post('/register', [CompanyController::class, 'register'])->name('register');
    Route::post('/logout', [CompanyController::class, 'destroy'])->name('logout');
    Route::get('/new-company', function () {
        return view('emails.new-company');
    })->name('new-company');
    Route::middleware('auth:web')->post('/follow/{companyid}', [CompanyController::class, 'follow'])->name('follow');
});
Route::middleware('auth:company')->name('company.')->prefix('company')->group(function () {
    Route::get('/dashboard', function () {
        $company = Auth::guard('company')->user();
        return view('companies.details', compact('company'));
    })->name('dashboard');
    Route::get('/edit/{companyid}',[CompanyController::class,'edit'])->name('edit');
    Route::put('/edit/{companyid}',[CompanyController::class,'update'])->name('update');
    Route::get('/jobs',[CompanyController::class,'jobs'])->name('jobs');
    Route::get('/appliers',[CompanyController::class,'appliers'])->name('appliers');

});

Route::middleware('auth')->group(function () {
    //Route for users
    Route::middleware('auth:web')->name('user.')->group(function () {
        Route::get('/appliments', [ApplierController::class,'userAppliments'])->name('appliments');
        Route::get('/update-cv', [ApplierController::class,'editCV'])->name('editCV');
        Route::put('/{applier}/update-cv', [ApplierController::class,'updateCV'])->name('updateCV');
        Route::get('/cv-detail', [ApplierController::class,'seeCV'])->name('seeCV');
    });

});
Route::post('/schedule-interview', [InterviewController::class, 'schedule'])->name('interviews.schedule');
Route::put('/interviews/{id}', [InterviewController::class, 'update'])->name('interviews.update');
Route::post('/notifications/mark-as-read', [App\Http\Controllers\NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');

require __DIR__.'/auth.php';
