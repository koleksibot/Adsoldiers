<?php

namespace App\Users\Domain\Resources;

use App\App\Domain\Resources\BaseResource;
use App\Campaigns\Domain\Resources\CampaignResource;

class UserResource extends BaseResource
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
                'email' => $this->email,
                'username' => $this->username,
                'company' => new CompanyResource($this->whenLoaded('company')),
                'permissions' => $this->getPermissions()->toArray(),
                'utm' => $this->utm,
                'role' => $this->roles->first()->slug,
                'tasks_lvl' => $this->tasks_lvl,
                'picture' => $this->picture,
                'address' => $this->address,
                'mobile' => $this->mobile,
                'ads' => CampaignResource::collection($this->whenLoaded('ads')),
                'soldier_ads' => CampaignResource::collection($this->whenLoaded('soldierAds')),
            ],
            parent::toArray($request)
        );
    }
}
