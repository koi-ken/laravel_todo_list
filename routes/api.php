<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ApiUserController;
use App\Http\Controllers\ApiTaskController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::Post('/v1/signup', [ApiUserController::class, 'signup']);
Route::Post('/v1/login', [ApiUserController::class, 'login']);
Route::Get('/v1/fetch_userinfo', [ApiUserController::class, 'fetch_userinfo']);
Route::Post('/v1/edit_userinfo', [ApiUserController::class, 'edit_userinfo']);
Route::Post('/v1/delete_userinfo', [ApiUserController::class, 'delete_userinfo']);
Route::Get('/v1/fetch_tasks', [ApiTaskController::class, 'fetch_tasks']);
Route::Get('/v1/fetch_task', [ApiTaskController::class, 'fetch_task']);
Route::Post('/v1/toggle_task_achive', [ApiTaskController::class, 'toggle_task_achive']);
Route::Post('/v1/edit_task', [ApiTaskController::class, 'edit_task']);
Route::Post('/v1/delete_task', [ApiTaskController::class, 'delete_task']);
