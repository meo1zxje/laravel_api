<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubitemController;

Route::apiResource('users', UserController::class);
Route::apiResource('articles', ArticleController::class);
Route::apiResource('categories', CategoryController::class);
Route::apiResource('subitems', SubitemController::class);