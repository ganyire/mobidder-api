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
     */
    public function __invoke(CreateProductRequest $request): JsonResponse
    {
        $product = Product::query()->create($request->validated());
        $product->load('category');

        $data = new ProductResource($product);

        return $this->success(message: 'Product created successfully', data: $data, httpCode: 201);
    }
}
