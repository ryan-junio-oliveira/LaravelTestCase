<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SystemController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TestCaseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TestExecutionController;

Route::middleware('auth')->group(function () {

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('systems', SystemController::class);
    Route::resource('test-cases', TestCaseController::class);

    Route::prefix('executions')->name('executions.')->group(function () {
        Route::get('/', [TestExecutionController::class, 'index'])->name('index');
        Route::post('/start', [TestExecutionController::class, 'start'])->name('start');
        Route::get('/{execution}', [TestExecutionController::class, 'show'])->name('show');
        Route::post('/{execution}/step', [TestExecutionController::class, 'updateStep'])->name('updateStep');
        Route::post('/{execution}/complete', [TestExecutionController::class, 'complete'])->name('complete');
        Route::post('/{execution}/reset', [TestExecutionController::class, 'reset'])->name('reset');
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
