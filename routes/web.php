<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CkeditorController;

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

Route::get('/', [PostController::class, 'posts'])->name('dashboard');

//Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', [PostController::class, 'posts'])->name('dashboard');

Route::get('/{user}/posts', [PostController::class, 'posts_user'])->name('user.posts');

Route::get('/post/{id}/{post}', [PostController::class, 'show'])->name('posts.show');

Route::get('/post/create', [PostController::class, 'create'])->name('posts.create');

Route::post('/post/create', [PostController::class, 'store'])->name('posts.store');

Route::get('/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');

Route::put('/{post}/update', [PostController::class, 'update'])->name('posts.update');

Route::delete('/{post}/delete', [PostController::class, 'destroy'])->name('posts.delete');

Route::post('/{post}/store_comment', [PostController::class, 'store_comment'])->name('posts.store_comment');

Route::post('/{post}/{comment}/store_answer', [PostController::class, 'store_answer'])->name('posts.store_answer');

Route::get('home', function(){
    return view('home');
})->name('home');


