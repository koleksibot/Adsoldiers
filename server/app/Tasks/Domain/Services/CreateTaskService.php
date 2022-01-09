<?php

namespace App\Tasks\Domain\Services;

use App\App\Domain\Payloads\GenericPayload;
use App\App\Domain\Services\LocalFileUploadService;
use App\App\Domain\Services\Service;
use App\Tasks\Domain\Repositories\TaskRepository;

class CreateTaskService extends Service
{
    protected $tasks;
    public function __construct(TaskRepository $tasks)
    {
        $this->tasks = $tasks;
    }
    public function handle($data = [])
    {
        // if task has media
        if (isset($data['media'])) {
            $storedFile = $this->handleFileUpload($data['media']);
            // store media with new unique name and get the name
            $data['media'] = $storedFile->getFileName();
            $data['media_type'] = $storedFile->getFileType();
        }

        $this->tasks->create($data);

        return new GenericPayload([
            'message' => 'task created successfully',
        ], 201);
    }
    public function handleFileUpload($file)
    {
        return (new LocalFileUploadService($file))->saveMany();
    }
}
