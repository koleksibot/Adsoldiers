<?php

namespace App\Ads\Domain\Services;

use App\Ads\Domain\Repositories\AdRepository;
use App\App\Domain\Payloads\GenericPayload;
use App\App\Domain\Services\Service;
use Illuminate\Support\Facades\DB;

class IndexCitiesService extends Service
{
    public function handle($country_id = null)
    {
        $cities = DB::select(
            "SELECT 
                `id`, 
                `city` as 'value' 
            FROM 
                `cities`
            WHERE 
                `country_id` in ($country_id)"
        );
        return new GenericPayload($cities);
    }
}
