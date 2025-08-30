<?php

use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});
Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
Route::get('/projects/{project}', [ProjectController::class, 'show'])->name('projects.show');
Route::get('/projects/create', [ProjectController::class, 'create'])->name('projects.create');
Route::post('/projects/store', [ProjectController::class, 'store'])->name('projects.store');
Route::get('/projects/edit/{project}', [ProjectController::class, 'edit'])->name('projects.edit');
Route::put('/projects/update/{project}', [ProjectController::class, 'update'])->name('projects.update');
Route::delete('/projects/destroy/{project}', [ProjectController::class, 'destroy'])->name('projects.destroy');
Route::get('/issues', [ProjectController::class, 'index'])->name('issues.index');
