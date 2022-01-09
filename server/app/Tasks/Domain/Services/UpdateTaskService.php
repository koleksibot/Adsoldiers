<?php

namespace App\Tasks\Domain\Services;

use App\App\Domain\Payloads\GenericPayload;
use App\App\Domain\Services\LocalFileUploadService;
use App\App\Domain\Services\Service;

class UpdateTaskService extends Service {
	public function handle($data = [], $task = null) {
		// if the media didn't updated
		// if task media updated
		if (isset($data['media'])) {
			$storedFile = $this->handleFileUpload($data['media']);
			// store media with new unique name and get the name
			$data['media'] = $storedFile->getFileName();
			$data['media_type'] = $storedFile->getFileType();
		} else {
			$data['media'] = $task->media;
		}

		$task->update($data);
		return new GenericPayload([
			'message' => 'Task Updated Successfully',
		]);
	}
	public function handleFileUpload($file) {
		return (new LocalFileUploadService($file))->saveMany();
	}
}