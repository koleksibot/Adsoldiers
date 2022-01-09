<?php

namespace App\Campaigns\Domain\Services;

use App\App\Domain\Payloads\GenericPayload;
use App\App\Domain\Services\Service;
use App\Campaigns\Domain\Repositories\CampaignRepository;

class IndexCampaignService extends Service
{
    protected $campaigns;

    public function __construct(CampaignRepository $campaigns)
    {
        $this->campaigns = $campaigns;
    }

    public function handle($data = [])
    {
        if (
            !is_null(auth()->user())
            && auth()->user()->roles()->first()->slug == 'advertiser'
        ) {
            return new GenericPayload(
                auth()->user()
                    ->campaigns()
                    ->orderBy('created_at', 'desc')
                    ->paginate(10)
            );
        }

        return new GenericPayload(
            $this->campaigns
                ->orderBy('created_at', 'desc')
                ->paginate(10)
        );
    }
}
