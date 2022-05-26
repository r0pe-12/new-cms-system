<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Users Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//Auth::routes();

Route::middleware('auth')->prefix('admin')->group(function (){

    //    display user
    Route::get('/user/{user}/profile', [\App\Http\Controllers\UserController::class, 'show'])->name('user.profile.show')->middleware('can:view,user');
    //    update user profile
    Route::put('/user/{user}/profile/update', [\App\Http\Controllers\UserController::class, 'update'])->name('user.profile.update');

    Route::middleware('role:admin')->group(function (){
        //    displaying all users
        Route::get('/users', [\App\Http\Controllers\UserController::class, 'index'])->name('users.index');
        //    deleting user
        Route::delete('/users/{user}/destroy', [\App\Http\Controllers\UserController::class, 'destroy'])->name('user.destroy');
    });
});
