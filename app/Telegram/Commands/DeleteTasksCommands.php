<?php

namespace App\Telegram\Commands;

use Telegram\Bot\Commands\Command;
use Telegram\Bot\Keyboard\Keyboard;
use App\Models\Task;

class DeleteTasksCommands extends Command
{
    protected string $name= 'delete_tasks';
    protected string $description= 'Delete tasks';

    public function handle()
    {
        $keyboard = Keyboard::make()->inline();
        $tasks = Task::all();
        foreach ($tasks as $task) {
            $keyboard->row([
                Keyboard::inlineButton([
                    'text' => $task->name,
                    'callback_data' => 'delete_'.$task->id,
                ])
            ]);
        }
        $this->replyWithMessage([
            'text' => 'Удалить:',
            'reply_markup' => $keyboard,]);
    }

}
