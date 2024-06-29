<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Area\AreaController;
use App\Http\Controllers\Collector\CollectorController;
use App\Http\Controllers\menumodule\MenumoduleController;
use App\Http\Controllers\Client\ClientController;
use App\Http\Controllers\menufunction\FunctionController;


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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::middleware(['auth'])->group(function () {

        Route::resource('user',UserController::class)->names('user');
        Route::resource('area',AreaController::class)->names('area');
        Route::get('area/fetch/{id}', [Controller::class, 'getAreas'])->name('area.fetch');
        Route::resource('collector',CollectorController::class)->names('collector');
        // Route::resource('client',ClientController::class)->names('client');
        Route::resource('menumodule',MenumoduleController::class)->names('menumodule');
        Route::resource('menufunction',FunctionController::class)->names('menufunction');
        // Route::post('client-save', [ClientController::Class,'save'])->name('client.save');

    // Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // Route::get('/profile', [ProfileController::class, 'index'])->name('profile');

    // Route::get('client', [ClientController::class, 'index'])->name('client.index');
    // Route::get('client-list', [ClientController::class, 'list'])->name('client.list');
    // Route::get('client-add', [ClientController::class, 'add'])->name('client.add');
    // Route::get('client-edit/{id?}', [ClientController::class, 'edit'])->name('client.edit');
    // Route::post('client-save/{id?}', [ClientController::class, 'save'])->name('client.save');
    // Route::get('client-find/{id?}', [ClientController::class, 'find'])->name('client.find');
    // // Route::delete('client-delete/{id?}', [ClientController::class, 'delete'])->name('client.delete');

    // Route::delete('test/{id?}', [ClientController::class, 'delete'])->name('test.delete');
    // Route::delete('clients/{client}', [ClientController::class, 'destroy'])->name('client.destroy');

    Route::resource('clients', ClientController::class)->names('clients'); 
});