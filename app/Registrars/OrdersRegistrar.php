<?php

namespace App\Registrars;

use App\Controllers\OrdersController;
use Mathrix\Lumen\Zero\Registrars\BaseRegistrar;

/**
 * Class OrdersRegistrar.
 *
 * @author Mathieu Bour <mathieu@mathrix.fr>
 * @copyright Mathrix Education SA.
 * @since 1.0.0
 */
class OrdersRegistrar extends BaseRegistrar
{
    /**
     * Register the routes.
     */
    public function register(): void
    {
        $controller = OrdersController::class;
        $this->post("/orders/webhook", "$controller@webhook");

        $this->rest([
            "std:patch" => "scope:orders:write",
            "rel:get:stocks" => "logged"
        ]);
    }
}
