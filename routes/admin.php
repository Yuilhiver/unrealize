<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminpageController;

Route::middleware(['auth','can:admin'])->prefix('admin/')->as('admin.')->group(function(){
    Route::get('users', [AdminpageController::class, 'users'])->name('users');
    Route::get('works', [AdminpageController::class, 'works'])->name('works');
    Route::get('articles', [AdminpageController::class, 'articles'])->name('articles');
    Route::get('collaborations', [AdminpageController::class, 'collaborations'])->name('collaborations');
});

