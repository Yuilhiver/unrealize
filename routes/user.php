<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\FeedController;
use Illuminate\Support\Facades\Route;

Route::resource('users', UserController::class)->except('edit')->middleware('auth');
Route::resource('users', UserController::class)->only('index','show');

Route::get('/users/{user}/profile_works', [UserController::class, 'profile_works'])->name('profile_works');
Route::get('/users/{user}/profile_article', [UserController::class, 'profile_article'])->name('profile_article');
Route::get('/users/{user}/profile_cols', [UserController::class, 'profile_cols'])->name('profile_cols');

Route::post('users/{user}/follow', [FollowerController::class,'follow'])->middleware('auth')->name('users.follow');
Route::post('users/{user}/unfollow', [FollowerController::class,'unfollow'])->middleware('auth')->name('users.unfollow');

Route::get('feed', FeedController::class)->middleware('auth')->name('feed');
