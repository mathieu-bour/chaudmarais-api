<?php

namespace App\Controllers;

use Mathrix\Lumen\Zero\Controllers\BaseController;

/**
 * Class ProductsController.
 *
 * @author Mathieu Bour <mathieu@mathrix.fr>
 * @copyright Mathrix Education SA.
 * @since 1.0.0
 */
class ProductsController extends BaseController
{
    protected $with = [
        "std:get" => "stocks"
    ];
}
