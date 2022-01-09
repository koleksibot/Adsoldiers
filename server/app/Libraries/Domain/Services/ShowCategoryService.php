<?php

namespace App\Libraries\Domain\Services;

use App\App\Domain\Payloads\GenericPayload;
use App\App\Domain\Services\Service;

class ShowCategoryService extends Service
{
    public function handle($category = null)
    {
        return new GenericPayload($category);
    }
}
