<?php

namespace App\Libraries\Domain\Services;

use App\App\Domain\Payloads\GenericPayload;
use App\App\Domain\Services\LocalFileUploadService;
use App\App\Domain\Services\Service;
use App\Libraries\Domain\Models\Category;
use App\Libraries\Domain\Repositories\LibraryRepository;
use Illuminate\Support\Arr;

class CreateLibraryService extends Service {
	protected $libraries;
	protected $categories;

	public function __construct(LibraryRepository $libraries, Category $categories) {
		$this->libraries = $libraries;
		$this->categories = $categories;
	}
	public function handle($data = []) {
		// if task has media
		if (isset($data['media'])) {
			$storedFile = $this->handleFileUpload($data['media']);
			// store media with new unique name and get the name
			$data['media'] = $storedFile->getFileName();
			$data['media_type'] = $storedFile->getFileType();
		}
		$a = $this->libraries->create(Arr::except($data, ['category']))->categories()->sync([1]);

		return new GenericPayload([
			'message' => 'library Created Successfully',
		]);
	}
	public function handleFileUpload($file) {
		return (new LocalFileUPloadService($file))->saveMany();
	}
}