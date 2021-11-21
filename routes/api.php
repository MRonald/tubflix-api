<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::prefix('/v1')->group(function () {
    Route::post('/auth/login', [AuthController::class, 'login']);

    // Rotas que necessitam do token de autenticação
    Route::group(['middleware' => ['apiJwt']], function () {
        // Grupo de rotas para autenticação
        Route::prefix('/auth')->group(function () {
            Route::post('/logout', [AuthController::class, 'logout']);
        });

        // Categorias
        Route::prefix('/categories')->group(function () {
            Route::get('/', [CategoryController::class, 'index']);
            Route::get('/{id}', [CategoryController::class, 'show']);
            Route::post('/', [CategoryController::class, 'store']);
            Route::put('/{id}', [CategoryController::class, 'store']);
            Route::delete('/{id}', [CategoryController::class, 'destroy']);
            Route::get('/{id}/videos', [CategoryController::class, 'videosCategory']);
        });

        // Videos
        Route::prefix('/videos')->group(function () {
            Route::get('/', [VideoController::class, 'index']);
            Route::get('/{id}', [VideoController::class, 'show']);
            Route::post('/', [VideoController::class, 'store']);
            Route::put('/{id}', [VideoController::class, 'store']);
            Route::delete('/{id}', [VideoController::class, 'destroy']);

            Route::post('/{videoId}/view', [VideoController::class, 'view']);
        });

        // Usuários
        Route::prefix('/users')->group(function () {
            Route::get('/', [UserController::class,'index']);
            Route::get('/{id}', [UserController::class,'show']);
            Route::post('/', [UserController::class,'store']);
            Route::put('/{id}', [UserController::class,'update']);
            Route::delete('/{id}', [UserController::class,'destroy']);
        });
    });
});

