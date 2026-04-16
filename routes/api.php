<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\MassController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\SongController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes — Choralis Back
|--------------------------------------------------------------------------
*/

Route::middleware('auth:sanctum')->group(function () {

    Route::get('/me', fn (Request $request) => $request->user());

    // ── Répertoire chants ───────────────────────────────────────────────
    Route::prefix('songs')->group(function () {
        Route::get('/', [SongController::class, 'index']);
        Route::post('/', [SongController::class, 'store']);
        Route::get('/{song}', [SongController::class, 'show']);
        Route::put('/{song}', [SongController::class, 'update']);
        Route::delete('/{song}', [SongController::class, 'destroy']);
    });

    // ── Liturgie messes ─────────────────────────────────────────────────
    Route::prefix('masses')->group(function () {
        Route::get('/', [MassController::class, 'index']);
        Route::post('/', [MassController::class, 'store']);
        Route::get('/{mass}', [MassController::class, 'show']);
        Route::post('/{mass}/parts/{part}/songs', [MassController::class, 'assignSong']);
        Route::get('/{mass}/pptx', [MassController::class, 'generatePptx']);
    });

    // ── Membres & rôles ─────────────────────────────────────────────────
    Route::prefix('users')->group(function () {
        Route::get('/', [UserController::class, 'index']);
        Route::post('/', [UserController::class, 'store']);
        Route::get('/{user}', [UserController::class, 'show']);
        Route::post('/{user}/roles', [UserController::class, 'assignRole']);
    });

    // ── Événements ──────────────────────────────────────────────────────
    Route::prefix('events')->group(function () {
        Route::get('/', [EventController::class, 'index']);
        Route::post('/', [EventController::class, 'store']);
        Route::get('/{event}', [EventController::class, 'show']);
        Route::post('/{event}/subscribe', [EventController::class, 'subscribe']);
        Route::post('/{event}/check-in', [EventController::class, 'checkIn']);
    });

    // ── Paiements ───────────────────────────────────────────────────────
    Route::prefix('events/{event}/payments')->group(function () {
        Route::get('/', [PaymentController::class, 'index']);
        Route::get('/users', [PaymentController::class, 'userPayments']);
        Route::post('/record', [PaymentController::class, 'record']);
    });
});
