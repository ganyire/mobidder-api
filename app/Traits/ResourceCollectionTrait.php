<?php

namespace App\Traits;

use Illuminate\Http\Request;


trait ResourceCollectionTrait
{
  /**
   * Determine if the resource should be paginated.
   *
   * @param Request $request
   * @return bool
   */
  public function shouldBePaginated(Request $request): bool
  {
    $perPage = $request->query('per_page', null);

    $isNumeric = !is_null($perPage) && is_numeric($perPage);

    return $isNumeric;
  }
}
