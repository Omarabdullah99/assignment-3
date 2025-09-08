<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//categories related route start
Route::get('/create/category', [CategoryController::class,'create'])->middleware('auth')->name('category.create');
Route::get('/categoires',[CategoryController::class,'index'])->middleware('auth')->name('category.index');
Route::post('/create/category',[CategoryController::class, 'store'])->middleware('auth')->name('category.store');
Route::get('/category/{category}/edit', [CategoryController::class, 'edit'])->name('category.edit');
Route::patch('/category/{category}', [CategoryController::class, 'update'])->name('category.update');
Route::delete('/category/{category}', [CategoryController::class, 'destroy'])->name('category.destroy');
//category related route end


//posts related route start
Route::get('/create/post', [PostController::class,'create'])->middleware('auth')->name('post.create');
Route::post('/create/post',[PostController::class, 'store'])->middleware('auth')->name('post.store');
Route::get('/posts',[PostController::class,'index'])->middleware('auth')->name('post.index');
Route::get('/posts/{post}',[PostController::class,'show'])->middleware('auth')->name('post.show');
Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('post.edit');
Route::patch('/posts/{post}', [PostController::class, 'update'])->name('post.update');
Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('post.destroy');
Route::post('/posts/{post}/publish', [PostController::class, 'publish'])->name('post.publish');
require __DIR__.'/auth.php';
