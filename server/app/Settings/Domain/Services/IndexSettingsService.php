<?php

namespace App\Settings\Domain\Services;

use App\App\Domain\Payloads\GenericPayload;
use App\App\Domain\Services\Service;
use App\Settings\Domain\Repositories\SettingRepository;

class IndexSettingsService extends Service {
	protected $settings;
	public function __construct(SettingRepository $settings) {
		$this->settings = $settings;
	}
	public function handle($data = []) {
		return new GenericPayload($this->settings->first());
	}
}