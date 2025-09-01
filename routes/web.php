<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\IssueController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});
Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
Route::get('/projects/create', [ProjectController::class, 'create'])->name('projects.create');
Route::post('/projects/store', [ProjectController::class, 'store'])->name('projects.store');
Route::get('/projects/{project}', [ProjectController::class, 'show'])->name('projects.show');
Route::get('/projects/edit/{project}', [ProjectController::class, 'edit'])->name('projects.edit');
Route::put('/projects/update/{project}', [ProjectController::class, 'update'])->name('projects.update');
Route::delete('/projects/destroy/{project}', [ProjectController::class, 'destroy'])->name('projects.destroy');
Route::get('/issues', [ProjectController::class, 'index'])->name('issues.index');

Route::get('/issues', [IssueController::class, 'index'])->name('issues.index');
Route::get('/issues/create', [IssueController::class, 'create'])->name('issues.create');
Route::post('/issues/store', [IssueController::class, 'store'])->name('issues.store');
Route::get('/issues/{issue}', [IssueController::class, 'show'])->name('issues.show');
Route::get('/issues/edit/{issue}', [IssueController::class, 'edit'])->name('issues.edit');
Route::put('/issues/update/{issue}', [IssueController::class, 'update'])->name('issues.update');
Route::delete('/issues/destroy/{issue}', [IssueController::class, 'destroy'])->name('issues.destroy');

Route::get('/tags', [TagController::class, 'index'])->name('tags.index');  
Route::get('/tags/create', [TagController::class, 'create'])->name('tags.create');  
Route::post('/tags', [TagController::class, 'store'])->name('tags.store'); 
Route::post('/tags/{issue}/attach-tag', [TagController::class, 'attachTag'])->name('tags.attachTag');
Route::post('/tags/{issue}/detach-tag', [TagController::class, 'detachTag'])->name('tags.detachTag');

Route::post('/comments/{issue}/comment', [CommentController::class, 'comment'])->name('comments.comment');
