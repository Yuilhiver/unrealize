<?php

use App\Http\Controllers\AchievementController;
use App\Http\Controllers\CreationController;
use App\Http\Controllers\WorkController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CollaborationController;
use Illuminate\Support\Facades\Route;

Route::get('/creation', [CreationController::class, 'index'])->name('creation.index')->middleware('auth');

Route::get('work_creation', [CreationController::class, 'work_creation'])->name('work_creation');
Route::get('article_creation', [CreationController::class, 'article_creation'])->name('article_creation');
Route::get('collab_creation', [CreationController::class, 'collab_creation'])->name('collab_creation');

// Creation page post requests
Route::post('work_creation', [WorkController::class, 'store']);
Route::post('article_creation', [ArticleController::class, 'store']);
Route::post('collab_creation', [CollaborationController::class, 'store']);
