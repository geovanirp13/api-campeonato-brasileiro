<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Player extends JsonResource
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
            'id'          => $this->id,
            'fullName'    => $this->fullName,
            'name'        => $this->name,
            'age'         => $this->age,
            'image'       => $this->image,
            'position'    => $this->position,
            'number'      => $this->number,
            'status'      => $this->status,
            'club'        => new Club($this->club)
        ];
    }
}
