<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\MainPageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisteredUserController;
use Illuminate\Support\Facades\Route;   

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
    return view('index');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/main', [MainPageController::class,'main'])->name('main');


Route::name('jobs.')->group(function () {
    Route::get('/jobs', [JobController::class, 'index'])->name('index');
    Route::get('/job-details/{jobid}', [JobController::class, 'details'])->name('details');
    Route::get('/job-apply', [JobController::class, 'apply'])->name('apply')->middleware('auth');
});

Route::name('companies.')->prefix('companies')->group(function () {
    Route::get('/', [CompanyController::class, 'index'])->name('index');
    Route::get('/company-details/{companyid}', [CompanyController::class, 'details'])->name('details');
    Route::post('/register', [CompanyController::class, 'register'])->name('register');
    Route::post('/logout', [CompanyController::class, 'destroy'])->name('logout');
    Route::get('/new-company', function () {
        return view('companies.new-company');
    })->name('new-company');
    Route::post('/follow/{companyid}',[CompanyController::class, 'follow'])->name('follow');
});
require __DIR__.'/auth.php';