<?php

namespace App\Telegram\Commands;

use App\Models\Task;
use Telegram\Bot\Commands\Command;
use Telegram\Bot\Keyboard\Keyboard;

class GetTasksCommand extends Command
{
    protected string $name = 'get_tasks';
    protected string $description = 'Get tasks';

    public function handle()
    {
        $keyboard = Keyboard::make()->inline();
        $tasks = Task::all();
        foreach ($tasks as $task) {
            $keyboard->row([
                Keyboard::inlineButton([
                    'text' => $task->name,
                    'callback_data' => 'get_' . $task->id,]),
            ]);
        }
        $this->replyWithMessage([
            'text' => 'Список задач:',
            'reply_markup' => $keyboard,]);
        }
}
