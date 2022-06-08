<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
|Roles Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//Auth::routes();

Route::middleware('auth')->prefix('admin')->group(function (){

    //    Displaying all roles
    Route::get('/roles', [\App\Http\Controllers\RoleController::class, 'index'])->name('role.index');
    //    creating roles
    Route::post('/roles', [\App\Http\Controllers\RoleController::class, 'store'])->name('role.store');
    //    deleting role
    Route::delete('/roles/{role}/destroy', [\App\Http\Controllers\RoleController::class, 'destroy'])->name('role.destroy')->can('modAdmin', 'role');
    //    displaying update role view
    Route::get('/roles/{role}/edit', [\App\Http\Controllers\RoleController::class, 'edit'])->name('role.edit')->middleware('can:modAdmin,role');
    //    updating role
    Route::patch('/roles/{role}/update', [\App\Http\Controllers\RoleController::class, 'update'])->name('role.update');

//    attaching permission
    Route::put('/roles/{role}/permissions/{permission}/attach', [\App\Http\Controllers\RoleController::class, 'attach'])->name('role.permission.attach');

//    detaching permission
    Route::put('/roles/{role}/permissions/{permission}/detach', [\App\Http\Controllers\RoleController::class, 'detach'])->name('role.permission.detach');

});

