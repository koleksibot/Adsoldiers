<?php

namespace App\Ads\Domain\Services;

use App\App\Domain\Payloads\GenericPayload;
use App\App\Domain\Services\Service;
use Illuminate\Support\Facades\DB;

class IndexLanguageService extends Service
{
    public function handle($data = [])
    {
        $language = DB::select(
            "SELECT 
               `id`, 
               `value`
           FROM `languages`"
        );
        return new GenericPayload($language);
    }
}
