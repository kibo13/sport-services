<?php

namespace App\Http\Resources\Trainer;


use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TrainerIndexResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'full_name' => $this->full_name,
        ];
    }
}
