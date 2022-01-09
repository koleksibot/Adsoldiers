<?php

namespace App\Libraries\Domain\Services;

use App\App\Domain\Payloads\GenericPayload;
use App\App\Domain\Services\LocalFileUploadService;
use App\App\Domain\Services\Service;

class UpdateLibraryService extends Service {
	public function handle($data = [], $library = null) {
		// if task has media
		if (isset($data['media'])) {
			$storedFile = $this->handleFileUpload($data['media']);
			// store media with new unique name and get the name
			$data['media'] = $storedFile->getFileName();
			$data['media_type'] = $storedFile->getFileType();
		}

		$library->update($data);

		return new GenericPayload([
			'message' => 'Library Updated Successfully',
		]);
	}
	public function handleFileUpload($file) {
		return (new LocalFileUploadService($file))->saveMany();
	}
}