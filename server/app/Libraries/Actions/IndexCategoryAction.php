<?php

namespace App\Libraries\Actions;

use App\Libraries\Domain\Services\IndexCategoryService;
use App\Libraries\Responders\IndexCategoryResponder;

class IndexCategoryAction
{
    public function __construct(IndexCategoryResponder $responder, IndexCategoryService $services)
    {
        $this->responder = $responder;
        $this->services = $services;
    }
    public function __invoke()
    {
        return $this->responder->withResponse(
            $this->services->handle()
        )->respond();
    }
}
