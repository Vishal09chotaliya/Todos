<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\GithubController;
use App\Http\Controllers\TodoController;
use App\Http\Middleware\ValidUser;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;


Route::get('/', function(){
    return view('welcome');
})->name('welcome');

Route::get('/dashbord', [TodoController::class, 'index'])->name('dashbord')->middleware(ValidUser::class);

Route::post('/store', [TodoController::class, 'store'])->name('store');

Route::post('/edit/{id}', [TodoController::class, 'edit'])->name('edit');

Route::delete('/delete/{id}', [TodoController::class, 'destroy'])->name('delete'); 

Route::get('/todos/{id}', [TodoController::class, 'getTodo']);

Route::get('/search-data', [TodoController::class, 'search'])->name('search');


// Authentication

Route::post('/register',  [AuthController::class, 'Register'])->name('register');

Route::post("/login", [AuthController::class, 'Login'])->name('login');

Route::get("/logout", [AuthController::class, 'Logout'])->name('logout');

Route::get('/forgot', [AuthController::class, 'forgot'])->name('forgot');

Route::post('/forgot-password', [AuthController::class, 'getEmailforForgot'])->name('get.emailforgot');

//google login
Route::get('/googlelogin', [AuthController::class, 'googleLogin'])->name('google.login');

Route::get('/google/dashbord', [AuthController::class, 'googleHandle'])->name('google.handle');


//Github Login

Route::get('/auth/github', [GithubController::class, 'githubLogin'])->name('github.login');

Route::get('/auth/callback', [GithubController::class, 'handleGithubCallback'])->name('github.callback');

//send email

Route::post('/sent-otp', [EmailController::class, 'sentOtp'])->name('sentOtp');

Route::post('/verify-otp',[EmailController::class,'verifyOtp'])->name('verifyOtp');

Route::get('/forgot-password-otp', [AuthController::class, 'forgotOtp'])->name('forgot.chage');


Route::post('forgot-change-password', [AuthController::class, 'forgotPassword'])->name('change.Password');


//change password

Route::get('/change-password', [AuthController::class, 'changePassword'])->name('dashbord.change.pass')->middleware(ValidUser::class);

Route::post('/change', [AuthController::class, 'changehere'])->name('change.pass')->middleware(ValidUser::class);
