<?php

namespace App\Tasks\Domain\Repositories;

use App\App\Domain\Repositories\Repository;
use App\Tasks\Domain\Models\Task;

class TaskRepository extends Repository {
	protected $model;

	public function __construct(Task $tasks) {
		$this->model = $tasks;
	}
}