<?php


namespace App\Registrars;


use App\Controllers\UsersController;
use Mathrix\Lumen\Zero\Registrars\BaseRegistrar;

class UsersRegistrar extends BaseRegistrar
{
    /**
     * Register the routes.
     */
    public function register(): void
    {
        $this->rest([
            "std:post" => null,
            "std:patch" => "logged",
        ]);
        $this->post("/users/login", UsersController::class . "@login");
    }
}
