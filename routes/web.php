<?php

use App\Http\Controllers\ApplierController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\MainPageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisteredUserController;
use Illuminate\Support\Facades\Route;
use App\Models\Job;
use Illuminate\Support\Facades\Auth;

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
    $jobs = Job::with('company')->latest()->take(6)->get();
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
    Route::middleware('auth:company')->get('/jobs/add', [JobController::class, 'create'])->name('add');
    Route::middleware('auth:company')->post('/jobs/add', [JobController::class, 'store'])->name('add');
    Route::get('/job-details/{jobid}', [JobController::class, 'details'])->name('details');
    Route::get('/job-apply', [JobController::class, 'apply'])->name('apply')->middleware('auth');
});

Route::name('companies.')->prefix('companies')->group(function () {
    Route::get('/', [CompanyController::class, 'index'])->name('index');
    Route::get('/details/{companyid}', [CompanyController::class, 'details'])->name('details');
    Route::post('/register', [CompanyController::class, 'register'])->name('register');
    Route::post('/logout', [CompanyController::class, 'destroy'])->name('logout');
    Route::get('/new-company', function () {
        return view('companies.new-company');
    })->name('new-company');
    Route::middleware('auth:web')->post('/follow/{companyid}', [CompanyController::class, 'follow'])->name('follow');
});
Route::middleware('auth:company')->name('company.')->prefix('company')->group(function () {
    Route::get('/dashboard', function () {
        $company = Auth::guard('company')->user();
        return view('companies.details', compact('company'));
    })->name('dashboard');
    Route::get('/edit/{companyid}',[CompanyController::class,'edit'])->name('edit');
    Route::get('/jobs',[CompanyController::class,'jobs'])->name('jobs');

});

Route::middleware('auth')->group(function () {
    //Route for users
    Route::middleware('auth:web')->name('user.')->group(function () {
        Route::get('/appliments', [ApplierController::class,'userAppliments'])->name('appliments');
    });

});
require __DIR__.'/auth.php';
