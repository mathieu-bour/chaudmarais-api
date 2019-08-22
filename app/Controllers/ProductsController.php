<?php

namespace App\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Mathrix\Lumen\Zero\Controllers\BaseController;
use Mathrix\Lumen\Zero\Exceptions\Http\Http400BadRequestException;
use Mathrix\Lumen\Zero\Exceptions\Http\Http401UnauthorizedException;
use Mathrix\Lumen\Zero\Responses\PaginationJsonResponse;

/**
 * Class ProductsController.
 *
 * @author Mathieu Bour <mathieu@mathrix.fr>
 * @copyright Mathrix Education SA.
 * @since 1.0.0
 */
class ProductsController extends BaseController
{
    /**
     * GET /products/enabled
     *
     * @param Request $request
     *
     * @return PaginationJsonResponse
     * @throws Http400BadRequestException
     * @throws Http401UnauthorizedException
     */
    public function enabled(Request $request)
    {
        $this->canOrFail($request, "enabled", Product::class);

        // Make the Eloquent query
        $query = Product::query()->where("enabled", "=", true);

        return new PaginationJsonResponse($query);
    }
}
