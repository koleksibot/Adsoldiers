<?php

namespace App\Analytics\Domain\Resources;

use App\App\Domain\Resources\BaseResource;

class ShowAnalyticsResource extends BaseResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'user_id' => $this['advertiser_id'] ?? $this['soldier_id'],
            'genders' => $this['genders'],
            'ages' => $this['ages'],
            'audience' => $this['audience'],
            'country' => $this['country'],
            'clicks' => $this['clicks'],
            'monthly_clicks' => $this['monthly_clicks'],
        ];
    }
}
