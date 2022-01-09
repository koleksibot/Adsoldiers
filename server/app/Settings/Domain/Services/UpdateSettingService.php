<?php

namespace App\Settings\Domain\Services;

use App\App\Domain\Payloads\GenericPayload;
use App\App\Domain\Services\LocalFileUploadService;
use App\App\Domain\Services\Service;
use App\Settings\Domain\Repositories\SettingRepository;

class UpdateSettingService extends Service {
	protected $settings;
	public function __construct(SettingRepository $settings) {
		$this->settings = $settings;
	}
	public function handle($data = []) {
		$imageKeys = ['about_us_image', 'mission_image', 'vision_image'];
		foreach ($imageKeys as $imagekey) {
			if (array_key_exists($imagekey, $data)) {
				$data[$imagekey] = $this->handleFileUpload($data[$imagekey])->getFileName();
			}
		}
		$this->settings->first()->update($data);
		return new GenericPayload([
			'message' => 'settings updated',
		]);
	}
	public function handleFileUpload($file) {
		return (new LocalFileUploadService($file))->save((dirname(base_path()) . '/client/assets/img'));
	}
}