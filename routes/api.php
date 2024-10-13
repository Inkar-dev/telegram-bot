<?php

use Illuminate\Support\Facades\Route;
use Telegram\Bot\Api;
use Telegram\Bot\Laravel\Facades\Telegram;

Route::post('/telegram-webhook', function () {

    $telegramUpdates = new \App\Http\Controllers\TelegramBotController();
    $telegramUpdates();


});
