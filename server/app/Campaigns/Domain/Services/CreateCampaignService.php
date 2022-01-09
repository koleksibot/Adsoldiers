<?php

namespace App\Campaigns\Domain\Services;

use App\App\Domain\Payloads\GenericPayload;
use App\App\Domain\Services\Service;

class CreateCampaignService extends Service
{
    protected $users;
    protected $ads;
    protected $currency;
    public function __construct()
    {
    }
    public function handle($data = [])
    {
        auth()->user()->campaigns()->create($data);

        return new GenericPayload(
            [
            'message' => 'Campaign Created Successfully',
            ],
            201
        );
    }
}
