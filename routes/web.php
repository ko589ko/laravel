<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;


Route::get('post/{post}/edit', [PostController::class, 'edit'])
->name('post.edit');
Route::patch('post/{post}', [PostController::class, 'update'])
->name('post.update');

Route::delete('post/{post}', [PostController::class, 'destroy'])
->name('post.destroy');
Route::get('/posts/{id}', [PostController::class, 'show'])->name('posts.show');


Route::get('post',[PostController::class, 'index'])->name('post.index');

Route::get('post/create',[PostController::class, 'create'])
->middleware(['auth','admin']);

Route::post('post', [PostController::class, 'store'])
->name('post.store');

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

require __DIR__.'/auth.php';
