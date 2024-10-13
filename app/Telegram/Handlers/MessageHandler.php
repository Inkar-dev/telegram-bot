<?php

namespace App\Telegram\Handlers;
use App\Models\Task;
use Telegram\Bot\Laravel\Facades\Telegram;
use Telegram\Bot\Objects\Update;

class MessageHandler {
    public static function handle( Update $updates )
    {
        $createTaskMessage = $updates->message->text;
        if (preg_match('/^Name:\s*(.+)\s*Description:\s*(.+)\s./', $createTaskMessage, $matches)) {
            $name = $matches[1];
            $description = $matches[2];

            $task = new Task();
            $task->name = $name;
            $task->description = $description;
            $task->save();

            return Telegram::sendMessage([
                'chat_id' => $updates->message->chat->id,
                'text' => "Task create successfully",]);
        }
        return Telegram::sendMessage([
            'chat_id' => $updates->message->chat->id,
            'text' => "*Send me a task in this format:*\n*Name:* Complete the task\n*Description:* The task must be completed before October 3",
            'parse_mode' => 'Markdown',]);
    }

}
