<?php

namespace App\Ads\Domain\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DecryptBayanPayResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'orderid' => $this->orderid,
            'amount' => $this->amount,
            'status' => $this->status,
            'status_msg' => $this->status_msg,
        ];
    }
}
