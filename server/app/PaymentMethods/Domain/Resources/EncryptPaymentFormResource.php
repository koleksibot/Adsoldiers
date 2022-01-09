<?php

namespace App\Ads\Domain\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EncryptPaymentFormResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'action' => $this->action,
            'request_parameter' => $this->request_parameter,
            'collaborator_id' => $this->collaborator_id,
            'merchant_id' => $this->merchant_id,
        ];
    }
}
