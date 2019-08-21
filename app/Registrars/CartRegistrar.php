<?php

namespace App\Registrars;

use App\Controllers\CartController;
use Mathrix\Lumen\Zero\Registrars\BaseRegistrar;

class CartRegistrar extends BaseRegistrar
{
    /**
     * Register the routes.
     */
    public function register(): void
    {
        $controller = CartController::class;
        $this->post("/cart/check", "$controller@check");
        $this->post("/cart/initialize", "$controller@initialize");
        $this->post("/cart/update/{paymentIntentId}", "$controller@update");
    }
}
