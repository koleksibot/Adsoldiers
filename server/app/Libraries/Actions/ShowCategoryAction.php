<?php

namespace App\Libraries\Actions;

use App\Libraries\Domain\Models\Category;
use App\Libraries\Domain\Services\ShowCategoryService;
use App\Libraries\Responders\ShowCategoryResponder;

class ShowCategoryAction
{
    public function __construct(ShowCategoryResponder $responder, ShowCategoryService $services)
    {
        $this->responder = $responder;
        $this->services = $services;
    }
    public function __invoke(Category $category)
    {
        return $this->responder->withResponse(
            $this->services->handle($category)
        )->respond();
    }
}
