<?php

namespace App\App\Domain\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BaseResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            // 'created_at_human' => $this->created_at->diffForHumans(),
            // 'updated_at_human' => $this->updated_at->diffForHumans(),
        ];
    }
}
