<?php

use App\Http\Controllers\CollectionController;
use App\Http\Controllers\DetailTransactionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransactionController;
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
Route::post('/userUpdate', [UserController::class, 'updateUser'])->name('user.update');

Route::get('/koleksi', [CollectionController::class, 'index'])->name('collection.index');
Route::get('/koleksiTambah', [CollectionController::class, 'create'])->name('collection.create');
Route::post('/koleksiStore', [CollectionController::class, 'store'])->name('collection.store');
Route::get('/koleksiView/{collection}', [CollectionController::class, 'show'])->name('collection.show');
Route::post('/koleksiUpdate', [CollectionController::class, 'update'])->name('collection.update');

Route::get('/transaksi', [TransactionController::class, 'index'])->name('transaction.index');
Route::get('/transaksiTambah', [TransactionController::class, 'create'])->name('transaction.create');
Route::post('/transaksiStore', [TransactionController::class, 'store'])->name('transaction.store');
Route::get('/transaksiView/{transaction}', [TransactionController::class, 'show'])->name('transaction.show');

route::get('/detailTransactionKembalikan/{detailTransactionId}', [DetailTransactionController::class, 'detailTransactionKembalikan'])->name('detailTransactionKembali');
Route::post('/detailTransactionUpdate', [DetailTransactionController::class, 'update'])->name('detailTransaction.update');



require __DIR__.'/auth.php';


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
