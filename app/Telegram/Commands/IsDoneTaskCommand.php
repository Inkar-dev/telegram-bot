<?php

namespace App\Telegram\Commands;

use App\Models\Task;
use Telegram\Bot\Commands\Command;
use Telegram\Bot\Keyboard\Keyboard;

class IsDoneTaskCommand extends Command
{
    protected string $name = 'is_done';
    protected string $description = 'Is done Command';

    public function handle()
    {
        $keyboard = Keyboard::make()->inline();
        $tasks = Task::where('is_done', 0)->get();
        if ($tasks->isNotEmpty()) {
            foreach ($tasks as $task) {
                $keyboard->row([
                    Keyboard::inlineButton([
                        'text' => $task->name,
                        'callback_data' => 'done_' . $task->id,]),
                ]);
            }
            $this->replyWithMessage([
                'text' => 'Список задач:',
                'reply_markup' => $keyboard,]);
        } else {
            $this->replyWithMessage([
                'text' => 'Список задач пуст'
                ]);
        }
    }
}
