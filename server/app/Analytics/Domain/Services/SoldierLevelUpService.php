<?php

namespace App\Analytics\Domain\Services;

use App\Analytics\Domain\Models\SoldierAnalytic;
use App\App\Domain\Payloads\GenericPayload;
use App\App\Domain\Services\Service;

class SoldierLevelUpService extends Service
{
    protected $utm;
    protected $analytics;

    public function __construct(SoldierAnalytic $analytics)
    {
        $this->utm = auth()->user()->utm ?? null;
        $this->analytics = $analytics;
    }

    public function handle($data = [])
    {
        // Retrieve record from analytics table with same utm as the authenticated user
        $result = $this->analytics->whereUserUtm($this->utm)->first();
        // increase tasks level to be 3 as google apis return results
        $this->userLevelUP($result);
        return new GenericPayload($result);
    }

    public function userLevelUP($result)
    {
        // if google apis returned data and user tasks level is 2
        if (auth()->user()->tasks_lvl == 2
            && !is_null($result)
        ) {
            // increase the user lvl
            auth()->user()->update(['tasks_lvl' => 3]);
        }
        // else if google apis didn't return data continue
        return;
    }
}
