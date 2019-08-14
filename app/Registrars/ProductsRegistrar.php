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
        $this->rest([
            "std:index" => null,
            "std:post" => "scope:products:write",
            "std:get" => null,
            "std:patch" => "scope:products:write",
            "rel:get:stocks" => null
        ]);
    }
}
