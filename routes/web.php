<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Handbook\SectionController;
use App\Http\Controllers\Handbook\GenderController;
use App\Http\Controllers\Handbook\StatusController;
use App\Http\Controllers\Handbook\PositionController;
use App\Http\Controllers\Fullcalendar\FullCalendarController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::middleware('auth')->group(function () {

    Route::resource('/users', UserController::class)->middleware('role:admin');

    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::resource('/sections', SectionController::class);
    Route::resource('/genders', GenderController::class);
    Route::resource('/statuses', StatusController::class);
    Route::resource('/positions', PositionController::class);
    
    Route::resource('/calendars', FullCalendarController::class );
});
