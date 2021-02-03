<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CursoController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('cursos', [CursoController::class, 'index'])->name('cursos.index');

Route::get('cursos/create', [CursoController::class, 'create'])->name('cursos.create');

Route::post('cursos/create/{curso}', [CursoController::class, 'store'])->name('cursos.store');

Route::get('cursos/{curso}/{slug}', [CursoController::class, 'show'])->name('cursos.show');

Route::get('cursos/{curso}/{slug}/edit', [CursoController::class, 'create'])->name('cursos.edit');

Route::put('cursos/{curso}/update', [CursoController::class, 'update'])->name('cursos.update');

Route::delete('cursos/destroy', [CursoController::class, 'destroy'])->name('cursos.delete');