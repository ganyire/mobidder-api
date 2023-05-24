<?php

namespace App\Http\Resources\General;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DateResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'for_human' => $this->diffForHumans(),
            'for_machine' => $this->toDateTimeString()
        ];
    }
}
