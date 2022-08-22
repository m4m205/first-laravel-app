<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ListController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::Get('/list/', [ListController::class, 'index']);
Route::Get('/list/{listId}', [ListController::class, 'Show']);
Route::Post('/list/', [ListController::class, 'store_list']);
Route::Post('/list/{listId}', [ListController::class, 'store_item']);
Route::Delete('/list/{listId}', [ListController::class, 'destroy_list']);
Route::Delete('/list/{listId}/{itemId}', [ListController::class, 'destroy_item']);
Route::Patch('/list/{listId}/{itemId}', [ListController::class, 'update_item']);
