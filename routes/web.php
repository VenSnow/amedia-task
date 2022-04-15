<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/', [TaskController::class, 'index'])->name('index');
    Route::name('task.')->group(function () {
        Route::get('/tasks', [TaskController::class, 'tasks'])->name('index');
        Route::post('/tasks', [TaskController::class, 'store'])->name('store');
    });
    Route::middleware('isManager')->group(function () {
        Route::get('/manager', [TaskController::class, 'manager'])->name('manager');
        Route::patch('/tasks/{task}', [TaskController::class, 'taskChange'])->name('manager.task.change');
    });
});

require __DIR__.'/auth.php';
