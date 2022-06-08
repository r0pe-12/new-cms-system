<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
|permissions Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//Auth::routes();

Route::middleware('auth')->prefix('admin')->group(function (){

    //    Displaying all permissions
    Route::get('/permissions', [\App\Http\Controllers\PermissionController::class, 'index'])->name('permission.index');
    //    creating permissions
    Route::post('/permissions', [\App\Http\Controllers\PermissionController::class, 'store'])->name('permission.store');
    //    deleting permission
    Route::delete('/permissions/{permission}/destroy', [\App\Http\Controllers\PermissionController::class, 'destroy'])->name('permission.destroy');
    //    displaying update permission view
    Route::get('/permissions/{permission}/edit', [\App\Http\Controllers\PermissionController::class, 'edit'])->name('permission.edit');
    //    updating permission
    Route::patch('/permissions/{permission}/update', [\App\Http\Controllers\PermissionController::class, 'update'])->name('permission.update');
});

