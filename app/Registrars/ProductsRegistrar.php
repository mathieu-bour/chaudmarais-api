<?php

namespace App\Registrars;

use App\Controllers\ProductsController;
use Mathrix\Lumen\Zero\Registrars\BaseRegistrar;

class ProductsRegistrar extends BaseRegistrar
{
    /**
     * Register the routes.
     */
    public function register(): void
    {
        $controller = ProductsController::class;

        $this->get("/products/enabled", "$controller@enabled");

        $this->rest([
            "std:index" => "scope:products:read",
            "std:post" => "scope:products:write",
            "std:get" => null,
            "std:patch" => "scope:products:write",
            "rel:get:stocks" => null
        ]);
    }
}
