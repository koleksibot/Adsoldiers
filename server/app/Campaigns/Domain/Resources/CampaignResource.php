<?php

namespace App\Campaigns\Domain\Resources;

use App\Ads\Domain\Resources\AdResourceCollection;
use App\App\Domain\Resources\BaseResource;
use App\Campaigns\Domain\Resources\CampaignResource;
use App\Users\Domain\Resources\CompanyResource;
use App\Users\Domain\Resources\UserResource;

class CampaignResource extends BaseResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return array_merge([
            'id' => $this->id,
            'title' => $this->title,
            'company' => new CompanyResource($this->whenLoaded('company')),
            'owner' => new UserResource($this->whenLoaded('owner')),
            'type' => $this->type,
            'ads' => new AdResourceCollection($this->whenLoaded('ads')),
        ], parent::toArray($request));
    }
}
