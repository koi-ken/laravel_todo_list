<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TopPageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ApiUserController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ApiTaskController;
use App\Http\Controllers\TemporaryUrlController;
use Illuminate\Support\Facades\Auth;

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
Route::get('/signup', [UserController::class, 'signup']);
Route::get('/login', [UserController::class, 'login'])->name('login');
Route::get('/logout', [UserController::class, 'logout']);
Route::get('/settings', [UserController::class, 'settings'])->middleware('auth');
Route::get('/temp_url/{slug}', [TemporaryUrlController::class, 'temp_url']);
Route::post('/api/v1/signup',[ApiUserController::class, 'signup']);
Route::post('/api/v1/login',[ApiUserController::class, 'login']);
Route::get('/api/v1/fetch_tasks', [ApiTaskController::class, 'fetch_tasks']);
Route::post('/api/v1/add_task', [ApiTaskController::class, 'add_task'])->middleware('auth');
Route::post('/api/v1/toggle_task_achive', [ApiTaskController::class, 'toggle_task_achive'])->middleware('auth');
Route::post('/api/v1/edit_task', [ApiTaskController::class, 'edit_task'])->middleware('auth');
Route::post('/api/v1/delete_task', [ApiTaskController::class, 'delete_task'])->middleware('auth');
Route::get('/api/v1/fetch_userinfo', [ApiUserController::class, 'fetch_userinfo'])->middleware('auth');