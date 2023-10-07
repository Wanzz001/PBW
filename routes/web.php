<?php

use App\Http\Controllers\CollectionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
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

// Nama: Wandi Ridwansyah
// NIM: 6706220080
// Kelas: 46-03
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

Route::get('/users', [UserController::class, 'index'])->name('user.index');
Route::get('/userRegistration', [UserController::class, 'create'])->name('user.create');
Route::post('/userStore', [UserController::class, 'store'])->name('user.store');
Route::get('/userView/{user}', [UserController::class, 'show'])->name('user.show');

Route::get('/koleksi', [CollectionController::class, 'index'])->name('collection.index');
Route::get('/koleksiTambah', [CollectionController::class, 'create'])->name('collection.create');
Route::post('/koleksiStore', [CollectionController::class, 'store'])->name('collection.store');
Route::get('/koleksiView/{collection}', [CollectionController::class, 'show'])->name('collection.show');


require __DIR__.'/auth.php';
