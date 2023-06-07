<?php

namespace App\Http\Controllers\Api\Category\Fetch;

use App\Http\Controllers\Controller;
use App\Http\Resources\Category\CategoryCollection;
use App\Models\Category;
use Illuminate\Http\Request;

/**
 * @group CATEGORY
 * 
 */

class GetCategoriesController extends Controller
{
    /**
     * Get all product categories
     * 
     * Endpoint for retrieving all product categories.
     * 
     * @queryParam per_page int The number of items to return per page. Example: 2
     * @queryParam page int The page number. Example: 1
     * 
     * @responseFile status=400 scenario='generic error (400-500)' storage/responses/generic_error.json
     * @responseFile status=200 scenario='success' storage/responses/category/get_categories.json
     */
    public function __invoke(Request $request)
    {
        $perPage = $request->query('per_page');
        $query = Category::query();

        $categories = $this->shouldBePaginated($request) ?
            $query->paginate($perPage) :
            $query->get();

        $data = new CategoryCollection($categories);

        return $this->success(data: $data);
    }
}
