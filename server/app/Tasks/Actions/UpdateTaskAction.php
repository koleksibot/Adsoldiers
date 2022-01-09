<?php

namespace App\Tasks\Actions;

use App\Tasks\Domain\Models\Task;
use App\Tasks\Domain\Requests\UpdateTaskFormRequest;
use App\Tasks\Domain\Services\UpdateTaskService;
use App\Tasks\Responders\UpdateTaskResponder;

class UpdateTaskAction {
	public function __construct(UpdateTaskResponder $responder, UpdateTaskService $services) {
		$this->responder = $responder;
		$this->services = $services;
	}
	public function __invoke(UpdateTaskFormRequest $request, Task $task) {
		return $this->responder->withResponse(
			$this->services->handle($request->validated(), $task)
		)->respond();
	}
}