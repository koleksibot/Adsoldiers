<?php

namespace App\Libraries\Domain\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->name,
            'cover_img' => $this->cover_img,
            'libraries' => new LibraryResourceCollection($this->libraries()->paginate(10)),
        ];
    }
}
