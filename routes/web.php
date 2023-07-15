<?php

use App\Http\Controllers\Back\BackHomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FrontHomeController;
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

Route::prefix('front')->name('front.')->group(function(){
    Route::get('/',FrontHomeController::class)->name('index')->middleware('auth');
});

Route::prefix('back')->name('back.')->group(function(){
    Route::get('/',BackHomeController::class)->middleware('admin')->name('index');
    require __DIR__.'/adminAuth.php';
});

Route::get('/', function () {
    return view('welcome');
});

require __DIR__.'/auth.php';



// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });



