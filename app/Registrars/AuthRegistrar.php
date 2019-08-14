<?php

namespace App\Registrars;

use App\Controllers\AuthController;
use Mathrix\Lumen\Zero\Registrars\BaseRegistrar;

/**
 * Class AuthRegistrar.
 *
 * @author Mathieu Bour <mathieu@mathrix.fr>
 * @copyright Mathrix Education SA.
 * @since 1.0.0
 */
class AuthRegistrar extends BaseRegistrar
{
    /**
     * Register the routes.
     */
    public function register(): void
    {
        $this->post("/auth/login", AuthController::class . "@login");
    }
}
