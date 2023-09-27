<?php

use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\UrlController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RedirectController;
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

Route::get('/', function () {
    return view('pages.home');
})->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::get('/dashboard', [DashboardController::class, 'index'])->name('user.dashboard');
    Route::post('/make-custom-url', [UrlController::class, 'makeCustomUrl'])->name('custom.url');
});


Route::get('/{url}', [RedirectController::class, 'redirectToUrl'])->name('redirect.shortUrl');


require __DIR__ . '/auth.php';
