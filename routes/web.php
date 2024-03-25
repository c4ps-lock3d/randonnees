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
Route::get('/randonnees/{slug}-{postgpx}', [\App\Http\Controllers\BlogController::class, 'show'])->where([
    'postgpx'=>'[0-9]+',
    'slug'=>'[a-z0-9\-]+'
])->name('blog.show');

// Télécharger GPX
Route::get('/download/{slug}-{postgpx}', [\App\Http\Controllers\BlogController::class, 'download'])->where([
    'postgpx'=>'[0-9]+',
    'slug'=>'[a-z0-9\-]+'
])->name('blog.download');

// Créer (sans GPX)
Route::get('/randonnees/new', [\App\Http\Controllers\BlogController::class, 'create'])->name('blog.create')->middleware('auth');
Route::post('/randonnees/new', [\App\Http\Controllers\BlogController::class, 'store']);

// Créer (avec GPX)
Route::get('/randonnees/new-gpx', [\App\Http\Controllers\BlogController::class, 'creategpx'])->name('blog.creategpx')->middleware('auth');
Route::post('/randonnees/new-gpx', [\App\Http\Controllers\BlogController::class, 'storegpx']);

// Editer
Route::get('/randonnees/{postgpx}/edit', [\App\Http\Controllers\BlogController::class,'edit'])->name('blog.edit');
Route::post('/randonnees/{postgpx}/edit', [\App\Http\Controllers\BlogController::class,'update']);

// Pages uniques
Route::get('/about', [\App\Http\Controllers\BlogController::class, 'about'])->name('blog.about');
Route::get('/carnets/corse2023', [\App\Http\Controllers\BlogController::class, 'corse2023'])->name('blog.corse2023');

