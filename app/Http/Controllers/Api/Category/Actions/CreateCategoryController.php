<?php

namespace App\Http\Controllers\Api\Category\Actions;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\CreateCategoryRequest;
use App\Http\Resources\Category\CategoryResource;
use App\Models\Category;
use Illuminate\Http\JsonResponse;

/**
 * @group CATEGORY
 * 
 * APIs for managing product categories and its related models
 */

class CreateCategoryController extends Controller
{
    /**
     * Create new product category
     */
    public function __invoke(CreateCategoryRequest $request): JsonResponse
    {
        $payload = $request->validated();
        $industry = Category::create($payload);

        $data = new CategoryResource($industry);

        return $this->success(message: 'Category created successfully', data: $data, httpCode: 201);
    }
}
