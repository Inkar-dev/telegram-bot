<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/set-webhook', function () {
    try {
        \Telegram\Bot\Laravel\Facades\Telegram::setWebhook(['url' => 'https://ccd6-5-188-65-228.ngrok-free.app/api/telegram-webhook']);

    } catch (Exception $exception) {
        dd($exception);
    }
});

Route::prefix('telegram')->group(function () {
    Route::get('/get-me', [\App\Http\Controllers\TelegramBotController::class, 'getMe']);
});
