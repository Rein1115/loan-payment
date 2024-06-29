<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\menus\MenusController;
use App\Http\Controllers\menufunction\FunctionController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::resource('test',MenusController::class)->names('test');

Route::resource('menufunction',FunctionController::class)->names('menufunction');


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
