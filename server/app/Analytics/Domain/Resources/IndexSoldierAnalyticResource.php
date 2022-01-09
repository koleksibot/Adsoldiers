<?php

namespace App\Analytics\Domain;

use App\App\Domain\Resources\BaseResource;

class IndexSoldierAnalyticResource extends BaseResource
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
            'id' => $this->id,
            'age' => $this->age,
            'gender' => $this->gender,
            'targeted_audience' => $this->targeted_audience,
        ];
    }
}
