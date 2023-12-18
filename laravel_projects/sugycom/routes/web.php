<?php

use App\Http\Controllers\PriorityController;
use App\Http\Controllers\ResearcherController;
use App\Http\Controllers\Trigger_planController;
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
    Route::resource('priority', PriorityController::class);
    Route::resource('researcher', ResearcherController::class);
    Route::get('trigger/{starttime?}', [Trigger_planController::class, 'index'])->name('trigger.index');
    Route::post('trigger/{starttime?}', [Trigger_planController::class, 'update'])->name('trigger.update');
});

require __DIR__.'/auth.php';
