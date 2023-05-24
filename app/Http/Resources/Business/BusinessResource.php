<?php

namespace App\Http\Resources\Business;

use App\Http\Resources\Address\AddressResource;
use App\Http\Resources\General\DateResource;
use App\Http\Resources\User\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BusinessResource extends JsonResource
{
    public $wap = true;
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->whenNotNull($this->phone),
            'website' => $this->whenNotNull($this->website),
            'logo' => $this->whenAppended('logo'),
            'created_at' => new DateResource($this->created_at),
            'address' => new AddressResource($this->whenLoaded('address')),
            'owner' => new UserResource($this->whenLoaded('user')),
        ];
    }
}
