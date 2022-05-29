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
    Route::get('/users/{user}/profile', [\App\Http\Controllers\UserController::class, 'show'])->name('user.profile.show')->middleware('can:view,user');
    //    update user profile
    Route::put('/users/{user}/profile/update', [\App\Http\Controllers\UserController::class, 'update'])->name('user.profile.update');
//    detaching roles
    Route::put('/users/{user}/roles/{role}/detach', [\App\Http\Controllers\UserController::class, 'detach'])->name('user.role.detach');

    Route::middleware('role:admin')->group(function (){
        //    displaying all users
        Route::get('/users', [\App\Http\Controllers\UserController::class, 'index'])->name('users.index');
        //    deleting user
        Route::delete('/users/{user}/destroy', [\App\Http\Controllers\UserController::class, 'destroy'])->name('user.destroy');
//        attaching roles
        Route::put('/users/{user}/roles/{role}/attach', [\App\Http\Controllers\UserController::class, 'attach'])->name('user.role.attach');
    });
});
