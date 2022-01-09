<?php

namespace App\Libraries\Domain\Services;

use App\App\Domain\Payloads\GenericPayload;
use App\App\Domain\Services\Service;
use App\Libraries\Domain\Repositories\LibraryRepository;

class IndexLibraryService extends Service
{
    protected $libraries;
    public function __construct(LibraryRepository $libraries)
    {
        $this->libraries = $libraries;
    }
    public function handle($data = [])
    {
        return new GenericPayload($this->libraries->paginate());
    }
}
