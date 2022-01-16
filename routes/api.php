<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{ContactController,RoleController};
use Illuminate\Support\Facades\Response;
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
// Route::resource('contact', ContactController::class)->except(['create','edit']);
Route::get('contact',[ContactController::class,'index']);
Route::post('contact/store',[ContactController::class,'store']);
Route::get('contact/show/{contact}',[ContactController::class,'show']);
Route::put('contact/update/{contact}',[ContactController::class,'update']);
Route::delete('contact/destroy/{contact}',[ContactController::class,'destroy']);

Route::get('roles',[RoleController::class,'index']);