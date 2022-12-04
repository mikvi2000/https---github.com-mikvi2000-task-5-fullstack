<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\loginController;
use App\Http\Controllers\articlesController;

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

Route::group(['prefix' => 'v1'], function() {
    Route::post('/login', [loginController::class, 'login'])->name('login');
    Route::get('/listAll', [articlesController::class, 'listAll'])->middleware('auth:api');
    Route::get('/showDetail', [articlesController::class, 'showDetail'])->middleware('auth:api');
    Route::post('/createArticle', [articlesController::class, 'createArticle'])->middleware('auth:api');
    Route::post('/updateArticle', [articlesController::class, 'updateArticle'])->middleware('auth:api');
    Route::post('/deleteArticle', [articlesController::class, 'deleteArticle'])->middleware('auth:api');
});
