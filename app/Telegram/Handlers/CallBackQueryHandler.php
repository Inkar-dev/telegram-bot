<?php

namespace App\Telegram\Handlers;
use App\Models\Task;
use Telegram\Bot\Laravel\Facades\Telegram;
use Telegram\Bot\Objects\Update;

class CallBackQueryHandler {
    public static function handle(Update $update)
    {
        $callbackQuery = $update->getCallbackQuery();
        $callbackData = $callbackQuery->getData();
        $chatId = $callbackQuery->getMessage()->getChat()->getId();
        if (strpos($callbackData, 'get_') === 0) {
            $taskId = str_replace('get_', '', $callbackData);
            $task = Task::find($taskId);
            if ($task) {
                Telegram::sendMessage([
                    'chat_id' => $chatId,
                    'text' => "*ID:* $task->id \n*Name:* $task->name \n*Description:* $task->description \n*Created at:* $task->created_at",
                    'parse_mode' => 'Markdown',]);
            } else {
                Telegram::sendMessage(['chat_id' => $chatId, 'text' => "Задача не найдена!"]);
            }
        }
        if (strpos($callbackData, 'done_') === 0) {
            $taskId = str_replace('done_', '', $callbackData);
            $task = Task::find($taskId);
            $task->is_done = 1;
            $task->save();
            if ($task) {
                Telegram::sendMessage([
                    'chat_id' => $chatId,
                    'text' => "Task $task->name is done successfully!",
                    ]);
            } else {
                Telegram::sendMessage(['chat_id' => $chatId, 'text' => "Задача не найдена!"]);
            }
        }
    }
}

