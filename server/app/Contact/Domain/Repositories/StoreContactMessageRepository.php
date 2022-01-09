<?php

namespace App\Contact\Domain\Repositories;

use App\App\Domain\Repositories\Repository;
use App\Contact\Domain\Models\Contact;

class StoreContactMessageRepository extends Repository {
	protected $model;
	public function __construct(Contact $contact) {
		$this->model = $contact;
	}
}