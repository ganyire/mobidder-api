<?php

namespace App\Http\Controllers\Api\Product\Actions;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\CreateProductRequest;
use App\Http\Resources\Product\ProductResource;
use App\Models\Product;
use Illuminate\Http\JsonResponse;

/**
 * @group PRODUCT
 * 
 * APIs for managing products and its related models
 */

class CreateProductController extends Controller
{
    /**
     * Create product
     * 
     * Endpoint for creating a new product.
     * 
     * @responseFile status=201 scenario='successful creation' storage/responses/create_product.json
     * @responseFile status=422 scenario='validation errors' storage/responses/validation_errors.json
     * @responseFile status=400 scenario='generic error (400-500)' storage/responses/generic_error.json
     */
    public function __invoke(CreateProductRequest $request): JsonResponse
    {
        $product = Product::query()->create($request->validated());
        $product->load('category');

        $data = new ProductResource($product);

        return $this->success(message: 'Product created successfully', data: $data, httpCode: 201);
    }
}
