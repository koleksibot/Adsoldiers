<?php

namespace App\Tasks\Actions;

use App\Tasks\Domain\Models\Task;
use App\Tasks\Domain\Services\DeleteTaskService;
use App\Tasks\Responders\DeleteTaskResponder;

class DeleteTaskAction {
	public function __construct(DeleteTaskResponder $responder, DeleteTaskService $services) {
		$this->responder = $responder;
		$this->services = $services;
	}
	public function __invoke(Task $task) {
		return $this->responder->withResponse(
			$this->services->handle($task)
		)->respond();
	}
}