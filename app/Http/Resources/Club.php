<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Club extends JsonResource
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
            'id'           => $this->id,
            'fullName'     => $this->fullName,
            'name'         => $this->name,
            'image'        => $this->image,
            'abbreviation' => $this->abbreviation,
            'nickname'     => $this->nickname,
            'color'        => $this->color,
            'stadium'      => $this->stadium
        ];
    }
}
