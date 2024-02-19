<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
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
    Route::get('/task-page', [TaskController::class, 'taskpage']);
    Route::get('/tasks-create', [TaskController::class, 'taskscreate'])->name('tasks.create');
    Route::post('/tasks.store', [TaskController::class, 'tasksstore'])->name('tasks.store');
    Route::get('/task-edit/{id}', [TaskController::class, 'taskseditpage'])->name('tasks.editpage');
    Route::put('/tasks.update/{id}', [TaskController::class, 'tasksupdate'])->name('tasks.update');

    // Route::put('/show-tasks', [TaskController::class, 'taskshow'])->name('tasks.update');
     Route::delete('/show-tasks/{id}', [TaskController::class, 'tasksdelete'])->name('tasks.destroy');
     Route::post('/tasks.complete/{id}', [TaskController::class, 'taskscomplete'])->name('tasks.complete');
     Route::get('/taskshow', [TaskController::class, 'taskshow'])->name('taskshow');
    
});

require __DIR__.'/auth.php';
