<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Area\AreaController;
use App\Http\Controllers\Collector\CollectorController;

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
    return view('welcome');
});
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::middleware(['auth'])->group(function () {

        Route::resource('user',UserController::class)->names('user');
        Route::resource('area',AreaController::class)->names('area');
        Route::resource('collector',CollectorController::class)->names('collector');


    // Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
});