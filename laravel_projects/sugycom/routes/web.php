<?php

use App\Http\Controllers\PriorityController;
use App\Http\Controllers\ResearcherController;
use App\Http\Controllers\Trigger_planController;
use App\Http\Controllers\SettingController;
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
    Route::resource('setting', SettingController::class);
    Route::get('trigger', [Trigger_planController::class, 'index'])->name('trigger.index');
    Route::post('trigger', [Trigger_planController::class, 'trigger'])->name('trigger.trigger');
    Route::post('compress', [Trigger_planController::class, 'compress'])->name('trigger.compress');
    Route::get('sender', [Trigger_planController::class, 'sender'])->name('trigger.sender');
});

require __DIR__.'/auth.php';
