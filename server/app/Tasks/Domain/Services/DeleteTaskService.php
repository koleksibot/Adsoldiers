<?php

namespace App\Tasks\Domain\Services;

use App\App\Domain\Payloads\GenericPayload;
use App\App\Domain\Services\Service;
use App\Tasks\Domain\Repositories\TaskRepository;

class DeleteTaskService extends Service {
	protected $tasks;
	public function __construct(TaskRepository $tasks) {
		$this->tasks = $tasks;
	}
	public function handle($task = null) {
		$task->delete();
		return new GenericPayload([
			'message' => 'Task Deleted Successfully',
		]);
	}
}