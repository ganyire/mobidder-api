<?php

namespace App\Http\Resources\Product;

use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\General\DateResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'average_price' => $this->average_price,
            'unit_of_measure' => $this->whenNotNull($this->unit_of_measure),
            'description' => $this->whenNotNull($this->description),
            'created_at' => new DateResource($this->created_at),
            'category' => new CategoryResource($this->whenLoaded('category')),
        ];
    }
}
