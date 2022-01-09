<?php

namespace App\Libraries\Domain\Services;

use App\App\Domain\Payloads\GenericPayload;
use App\App\Domain\Services\Service;
use App\Libraries\Domain\Models\Category;

class IndexCategoryService extends Service
{
    protected $categories;
    public function __construct(Category $categories)
    {
        $this->categories = $categories;
    }
    public function handle($data = [])
    {
        return new GenericPayload($this->categories->with('libraries')->get());
    }
}
