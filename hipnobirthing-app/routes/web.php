<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Mother\DashboardController;
use App\Http\Controllers\Mother\PregnancyController;
use App\Http\Controllers\Mother\HarsController;
use App\Http\Controllers\Mother\QaController;
use App\Http\Controllers\Mother\ReminderController;
use App\Http\Controllers\Mother\RelaxationController;
use App\Http\Controllers\Mother\TrimesterDiscomfortController;

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::get('/pregnancy', [PregnancyController::class, 'index'])->name('pregnancy.index');
    Route::post('/pregnancy', [PregnancyController::class, 'store'])->name('pregnancy.store');

    Route::get('/hars', [HarsController::class, 'index'])->name('mother.hars');
    Route::post('/hars', [HarsController::class, 'store'])->name('hars.store');
    Route::get('/hars/history', [HarsController::class, 'history'])->name('hars.history');

    Route::get('/qa', [QaController::class, 'index'])->name('mother.qa');
    Route::post('/qa', [QaController::class, 'store'])->name('qa.store');

    Route::get('/reminder', [ReminderController::class, 'index'])->name('reminder.index');

    Route::post('/reminder', [ReminderController::class, 'store'])->name('reminder.store');

    Route::put('/reminder/{id}', [ReminderController::class, 'update'])->name('reminder.update');

    Route::delete('/reminder/{id}', [ReminderController::class, 'destroy'])->name('reminder.destroy');

    Route::get('/relaxation', [RelaxationController::class, 'index'])
        ->name('mother.relaxation');

    Route::post(
        '/relaxation/session',
        [RelaxationController::class, 'storeSession']
    )->name('relaxation.session');

    Route::get(
        '/panduan-kehamilan',
        [TrimesterDiscomfortController::class, 'index']
    )->name('mother.panduan');

    Route::get(
        '/panduan-kehamilan/trimester/{trimester}',
        [TrimesterDiscomfortController::class, 'index']
    )->name('panduan.trimester');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
