<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TopPageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TemporaryUrlController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [TaskController::class, 'task_list']);
Route::get('/', [TopPageController::class, 'toppage']);
Route::get('/signup', [UserController::class, 'signup']);
Route::get('/login', [UserController::class, 'login']);
Route::get('/logout', [UserController::class, 'logout']);
Route::get('/settings', [UserController::class, 'settings']);
Route::get('/temp_url/{slug}', [TemporaryUrlController::class, 'temp_url']);

