<?php

namespace App\Http\Controllers\Api\Business\Actions;

use App\Http\Controllers\Controller;
use App\Http\Requests\Business\CreateBusinessRequest;
use App\Http\Resources\Business\BusinessResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
 * @group BUSINESS 
 * 
 * APIs for managing business model and its related models
 */

class CreateBusinessController extends Controller
{
    /**
     *  Create new business
     * 
     * @apiResource  App\Http\Resources\Business\BusinessResource 
     * @apiResourceModel App\Models\Business 
     */
    public function __invoke(CreateBusinessRequest $request): JsonResponse
    {
        $business = DB::transaction(function () use ($request) {
            $business = $request->user()->businesses()->create($request->validated());
            if ($request->has('logo')) {
                $business->addMedia($request->file('logo'))->toMediaCollection('logo');
            }
            if ($request->has('street')) {
                $business->address()->create($request->validated());
                $business->load('address');
            }
            return $business;
        });

        $data = new BusinessResource($business);

        return $this->success(message: 'Business created successfully', data: $data);
    }
}
