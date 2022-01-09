<?php

namespace App\Tasks\Domain\Services;

use App\App\Domain\Payloads\GenericPayload;
use App\App\Domain\Services\Service;
use App\Tasks\Domain\Repositories\TaskRepository;

class IndexTasksService extends Service
{
    protected $tasks;
    protected $task_lvl;

    public function __construct(TaskRepository $tasks)
    {
        $this->tasks = $tasks;
    }
    public function handle($user = null)
    {
        return new GenericPayload($this->tasks->where('id', '<=', $user->tasks_lvl)->get());
    }
}
