<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/post/{post}', [\App\Http\Controllers\PostController::class, 'show'])->name('post');

Route::middleware('auth')->group(function (){

    Route::get('/admin', [\App\Http\Controllers\AdminController::class, 'index'])->name('admin.index');

//    Displaying create form
    Route::get('/admin/posts/create', [\App\Http\Controllers\PostController::class, 'create'])->name('post.create');
//    Displaying all posts
    Route::get('/admin/posts', [\App\Http\Controllers\PostController::class, 'index'])->name('post.index');
//    creating posts
    Route::post('/admin/posts', [\App\Http\Controllers\PostController::class, 'store'])->name('post.store');
//    deleting post
    Route::delete('/admin/posts/{post}/destroy', [\App\Http\Controllers\PostController::class, 'destroy'])->middleware('can:view,post')->name('post.destroy');
//    displaying update post view
    Route::get('/admin/posts/{post}/edit', [\App\Http\Controllers\PostController::class, 'edit'])->middleware('can:view,post')->name('post.edit');
//    updating post
    Route::patch('/admin/posts/{post}/update', [\App\Http\Controllers\PostController::class, 'update'])->name('post.update');

//    display user
    Route::get('admin/user/{user}/profile', [\App\Http\Controllers\UserController::class, 'show'])->name('user.profile.show');

});
