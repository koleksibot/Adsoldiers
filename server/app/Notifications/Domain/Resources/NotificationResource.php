<?php

namespace App\Notifications\Domain\Resources;

use App\App\Domain\Resources\BaseResource;

class NotificationResource extends BaseResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return array_merge([
            'id' => $this->id,
            'type' => $this->type,
            'type_class' => $this->type_class,
            'notifiable_type' => $this->notifiable_type,
            'notifiable_id' => $this->notifiable_id,
            'data' => $this->data,
            'models' => $this->models,
            'read_at' => $this->read_at,
        ], parent::toArray($request));
    }
}
