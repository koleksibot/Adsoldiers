<?php

namespace App\Libraries\Domain\Repositories;

use App\App\Domain\Repositories\Repository;
use App\Libraries\Domain\Models\Library;

class LibraryRepository extends Repository
{
    protected $model;

    public function __construct(Library $library)
    {
        $this->model = $library;
    }
}
