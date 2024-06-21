<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Area\AreaController;
use App\Http\Controllers\Collector\CollectorController;
use App\Http\Controllers\menus\MenusController;

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
        Route::get('area/fetch/{id}', [Controller::class, 'getAreas'])->name('area.fetch');
        Route::resource('collector',CollectorController::class)->names('collector');
        Route::resource('menus',MenusController::class)->names('menus');

    // Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
});