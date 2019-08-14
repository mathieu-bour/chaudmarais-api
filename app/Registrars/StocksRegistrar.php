<?php

namespace App\Registrars;

use Mathrix\Lumen\Zero\Registrars\BaseRegistrar;

/**
 * Class StocksRegistrar.
 *
 * @author Mathieu Bour <mathieu@mathrix.fr>
 * @copyright Mathrix Education SA.
 * @since 1.0.0
 */
class StocksRegistrar extends BaseRegistrar
{
    /**
     * Register the routes.
     */
    public function register(): void
    {
        $this->rest([
            "std:post" => "stocks:write",
            "std:patch" => "stocks:write"
        ]);
    }
}
