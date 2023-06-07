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
     * 
     * Endpoint for creating a new product category.
     * 
     * @responseFile status=201 scenario='successful creation' storage/responses/create_category.json
     * @responseFile status=422 scenario='validation errors' storage/responses/validation_errors.json
     * @responseFile status=400 scenario='generic error (400-500)' storage/responses/generic_error.json
     */
    public function __invoke(CreateCategoryRequest $request): JsonResponse
    {
        $payload = $request->validated();
        $industry = Category::create($payload);

        $data = new CategoryResource($industry);

        return $this->success(message: 'Category created successfully', data: $data, httpCode: 201);
    }
}
