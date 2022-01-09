<?php

namespace App\Ads\Domain\Services;

use App\App\Domain\Services\Service;
use App\App\Domain\Payloads\GenericPayload;
use App\Ads\Domain\Repositories\AdRepository;
use App\App\Domain\Payloads\ValidationPayload;

class SubscribeAdService extends Service
{
    protected $ads;

    public function __construct(AdRepository $ads)
    {
        $this->ads = $ads;
    }

    public function handle($ad = [])
    {
        if (!empty($ad->soldier->find(auth()->user()->id))) {
            return new ValidationPayload(['message' => 'You have already subscribe to this ad']);
        }

        if ($ad->soldier->sum('limit') > $ad->budget) {
            return new ValidationPayload(['message' => 'This ad has reached the subscription limit']);
        }

        // subscribe
        $ad->soldier()->attach(auth()->user()->id);

        return new GenericPayload(['message' => 'You have subscribed successfully to this ad']);
    }
}
