<?php

namespace App\Registrars;

use Mathrix\Lumen\Zero\Registrars\BaseRegistrar;

/**
 * Class AddressesRegistrar.
 *
 * @author Mathieu Bour <mathieu@mathrix.fr>
 * @copyright Mathrix Education SA.
 * @since
 */
class AddressesRegistrar extends BaseRegistrar
{
    /**
     * Register the routes.
     */
    public function register(): void
    {
        $this->rest([
            "std:post" => "logged",
            "std:patch" => "logged"
        ]);
    }
}
