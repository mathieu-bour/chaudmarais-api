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
        $this->get("/products", ProductsController::class . "@index");
    }
}
