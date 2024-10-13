<?php

namespace App\Telegram\Commands;

use Telegram\Bot\Commands\Command;

class CreateTasksCommands extends Command
{
    protected string $name = 'create_task';
    protected string $description = 'Create task';

    public function handle()
    {
        $this->replyWithMessage([
            'text' => "*Send me a task in this format:*\n*Name:* Complete the task\n*Description:* The task must be completed before October 3",
            'parse_mode' => 'Markdown',
        ]);
    }
}
