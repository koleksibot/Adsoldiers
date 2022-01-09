<?php

namespace App\Ads\Domain\Services;

use App\Ads\Domain\Repositories\AdRepository;
use App\App\Domain\Payloads\GenericPayload;
use App\App\Domain\Services\Service;
use Illuminate\Support\Facades\DB;

class IndexCountriesService extends Service
{
    public function handle($data = [])
    {
        $countries = DB::select(
            "SELECT 
                `id`,
                `country` as 'value'
            FROM 
                `countries`"
        );
        return new GenericPayload($countries);
    }
}
