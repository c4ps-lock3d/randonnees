<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Welcome
Route::get('/', [\App\Http\Controllers\BlogController::class, 'welcome'])->name('blog.welcome');

// Authentification
Route::get('/login', [\App\Http\Controllers\AuthController::class, 'login'])->name('auth.login');
Route::delete('/logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('auth.logout');
Route::post('/login', [\App\Http\Controllers\AuthController::class, 'dologin']);

// Afficher
Route::get('/randonnees', [\App\Http\Controllers\BlogController::class, 'index'])->name('blog.index');
//Route::get('/triDistance', [\App\Http\Controllers\BlogController::class, 'indexTriDistance'])->name('blog.indexTriDistance');
Route::get('/randonnees/{slug}-{post}', [\App\Http\Controllers\BlogController::class, 'show'])->where([
    'post'=>'[0-9]+',
    'slug'=>'[a-z0-9\-]+'
])->name('blog.show');

// Créer
Route::get('/randonnees/new', [\App\Http\Controllers\BlogController::class, 'create'])->name('blog.create')->middleware('auth');
Route::post('/randonnees/new', [\App\Http\Controllers\BlogController::class, 'store']);

// Editer
Route::get('/randonnees/{post}/edit', [\App\Http\Controllers\BlogController::class,'edit'])->name('blog.edit');
Route::post('/randonnees/{post}/edit', [\App\Http\Controllers\BlogController::class,'update']);

// Pages uniques
Route::get('/about', [\App\Http\Controllers\BlogController::class, 'about'])->name('blog.about');
Route::get('/carnets/corse2023', [\App\Http\Controllers\BlogController::class, 'corse2023'])->name('blog.corse2023');