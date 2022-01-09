<?php

namespace App\Contact\Domain\Services;

use App\App\Domain\Payloads\GenericPayload;
use App\App\Domain\Services\Service;
use App\Contact\Domain\Repositories\StoreContactMessageRepository;

class StoreContactMessageService extends Service {
	protected $contact;
	public function __construct(StoreContactMessageRepository $contact) {
		$this->contact = $contact;
	}
	public function handle($data = []) {
		$contactMessage = $this->contact->create($data);
		return new GenericPayload($contactMessage);
	}
}