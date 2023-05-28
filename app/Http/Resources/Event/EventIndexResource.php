<?php

namespace App\Http\Resources\Event;


use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EventIndexResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id'      => $this->id,
            'title'   => $this->title,
            'type'    => $this->specialization->name,
            'trainer' => $this->trainer->full_name,
            'start'   => $this->start,
            'end'     => $this->end,
            'place'   => $this->place,
        ];
    }
}
