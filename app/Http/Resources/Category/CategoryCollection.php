<?php

namespace App\Http\Resources\Category;

use App\Traits\ResourceCollectionTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CategoryCollection extends ResourceCollection
{

    use ResourceCollectionTrait;

    public function withPagination(Request $request): array|null
    {
        return $this->shouldBePaginated($request) ? [
            'total' => $this->total(),
            'current_page_total' => $this->count(),
            'per_page' => $this->perPage(),
            'current_page' => $this->currentPage(),
            'has_more_pages' => $this->hasMorePages(),
        ] :  null;
    }

    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request)
    {
        return  [
            'categories' => $this->collection,
            'pagination' => $this->withPagination($request),
        ];
    }
}
