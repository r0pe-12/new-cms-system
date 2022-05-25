<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Posts Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/post/{post}', [\App\Http\Controllers\PostController::class, 'show'])->name('post');

Route::middleware('auth')->prefix('admin')->group(function (){

    //    Displaying create form
    Route::get('/posts/create', [\App\Http\Controllers\PostController::class, 'create'])->name('post.create');
    //    Displaying all posts
    Route::get('/posts', [\App\Http\Controllers\PostController::class, 'index'])->name('post.index');
    //    creating posts
    Route::post('/posts', [\App\Http\Controllers\PostController::class, 'store'])->name('post.store');
    //    deleting post
    Route::delete('/posts/{post}/destroy', [\App\Http\Controllers\PostController::class, 'destroy'])->middleware('can:view,post')->name('post.destroy');
    //    displaying update post view
    Route::get('/posts/{post}/edit', [\App\Http\Controllers\PostController::class, 'edit'])->middleware('can:view,post')->name('post.edit');
    //    updating post
    Route::patch('/posts/{post}/update', [\App\Http\Controllers\PostController::class, 'update'])->name('post.update');
});

