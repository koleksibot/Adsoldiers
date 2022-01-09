<?php

namespace App\Tasks\Actions;

use App\Tasks\Domain\Models\Task;
use App\Tasks\Domain\Services\ShowTaskService;
use App\Tasks\Responders\ShowTaskResponder;

class ShowTaskAction {
	public function __construct(ShowTaskResponder $responder, ShowTaskService $services) {
		$this->responder = $responder;
		$this->services = $services;
	}
	public function __invoke(Task $task) {
		return $this->responder->withResponse(
			$this->services->handle($task)
		)->respond();
	}
}