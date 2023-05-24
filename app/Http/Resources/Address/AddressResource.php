<?php

namespace App\Http\Resources\Address;

use App\Http\Resources\General\DateResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AddressResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'street' => $this->street,
            'city' => $this->whenNotNull($this->city),
            'state' => $this->whenNotNull($this->state),
            'country' => $this->whenNotNull($this->country),
            'zip_code' => $this->whenNotNull($this->zip_code),
            'created_at' => new DateResource($this->created_at),
        ];
    }
}
