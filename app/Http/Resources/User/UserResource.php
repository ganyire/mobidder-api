<?php

namespace App\Http\Resources\User;

use App\Http\Resources\Address\AddressResource;
use App\Http\Resources\Business\BusinessResource;
use App\Http\Resources\General\DateResource;
use App\Http\Resources\Role\RoleResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public $token;

    public function __construct(mixed $resource, string $_token = null)
    {
        parent::__construct($resource);
        $this->token = $_token;
    }
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'email' => $this->email,
            'name' => $this->whenNotNull($this->name),
            'phone' => $this->whenNotNull($this->phone),
            'accountIsLocked' => $this->locked,
            'emailIsVerified' => $this->hasVerifiedEmailAddress(),
            'created_at' => new DateResource($this->created_at),
            'role' => new RoleResource($this->whenAppended('role')),
            'address' => new AddressResource($this->whenLoaded('address')),
            'businesses' => BusinessResource::collection($this->whenLoaded('businesses')),
            'token' => $this->whenNotNull($this->token),
        ];
    }
}
