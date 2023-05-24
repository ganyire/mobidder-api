<?php

namespace App\Http\Resources\Category;

use App\Http\Resources\General\DateResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
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
            'name' => $this->name,
            'slug' => $this->whenAppended('slug'),
            'description' => $this->whenNotNull($this->description),
            'created_at' => new DateResource($this->created_at),
        ];
    }
}
