<?php

namespace App\Ads\Domain\Resources;

use App\App\Domain\Resources\BaseResource;
use App\Campaigns\Domain\Resources\CampaignResource;

class AdResource extends BaseResource
{
  
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return array_merge(
            [
                'id' => $this->id,
                'title' => $this->title,
                'content' => $this->content,
                'start_date' => $this->start_date,
                'end_date' => $this->end_date,
                'media' => $this->media,
                'media_type' => $this->media_type,
                'budget' => $this->budget,
                'remaining_budget' => $this->remaining_budget,
                'gender' => $this->gender,
                'age' => $this->age,
                'targeted_audience' => $this->targeted_audience,
                'country' => $this->country,
                'clicks' => $this->clicks,
                'city' => $this->city,
                'language' => $this->language,
                'status' => $this->status,
                'call_of_action_txt' => $this->call_of_action_txt,
                'call_of_action_url' => $this->call_of_action_url,
                'campaign' => new CampaignResource($this->whenLoaded('campaign')),
            ],
            ['sa'=> 'sa']
        );
    }
}
