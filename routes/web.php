<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\WorkController;
use App\Http\Controllers\CollaborationController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\IndexController;
use Illuminate\Support\Facades\Route;

require __DIR__ . '/auth.php';
require __DIR__ . '/user.php';
require __DIR__ . '/creation.php';
require __DIR__ . '/admin.php';

Route::get('/', [IndexController::class, 'index'])->name('index');

Route::resource('works', WorkController::class)->except(['create'])->middleware('auth');
Route::resource('works', WorkController::class)->only(['index', 'show']);
Route::resource('works.comments', CommentController::class)->only(['store','destroy'])->middleware('auth');

Route::resource('articles', ArticleController::class)->except(['create'])->middleware('auth');
Route::resource('articles', ArticleController::class)->only(['index', 'show']);

Route::resource('collaborations', CollaborationController::class)->except(['create'])->middleware('auth');
Route::resource('collaborations', CollaborationController::class)->only(['index', 'show']);


