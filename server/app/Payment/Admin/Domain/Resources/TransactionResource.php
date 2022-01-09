<?php

namespace App\Payment\Admin\Domain\Resources;

use App\Ads\Domain\Resources\AdResourceCollection;
use App\App\Domain\Resources\BaseResource;
use App\Campaigns\Domain\Resources\CampaignResource;
use App\Users\Domain\Resources\CompanyResource;
use App\Users\Domain\Resources\UserResource;

class TransactionResource extends BaseResource
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
            "id" =>  $this->id,
            "transNumber" =>  $this->transNumber,
            "soldier_id" =>  $this->soldier_id,
            "amount" =>  $this->amount,
            "balance" =>  $this->balance,
            "status" =>  $this->status,
            "created_at" =>  $this->created_at,
            "updated_at" =>  $this->updated_at,
            "soldier" =>  new UserResource($this->soldier),
        ], parent::toArray($request));
    }
}
