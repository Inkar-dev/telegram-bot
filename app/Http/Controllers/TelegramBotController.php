<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Telegram\Handlers\CallBackQueryHandler;
use App\Telegram\Handlers\MessageHandler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Telegram\Bot\Api;
use Telegram\Bot\Laravel\Facades\Telegram;
use Telegram\Bot\Objects\CallbackQuery;
use Telegram\Bot\Objects\Update;
use function PHPUnit\Framework\callback;

class TelegramBotController extends Controller
{
    public function __invoke()
    {
        $updates = Telegram::getWebhookUpdate();

        if ($updates->isType('callback_query')) {
            CallbackQueryHandler::handle($updates);
        }
        if ($updates->isType('message')) {
            $message = $updates->getMessage();

            if (!str_starts_with($message->getText(), '/')) {
                MessageHandler::handle($updates);
            } else {
                Telegram::commandsHandler(true);
            }
        }
        return response()->json(['status' => 'ok']);
    }
}
