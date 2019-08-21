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
            "std:get" => "logged",
            "std:patch" => "logged",
            "rel:get:addresses" => "logged",
            "rel:get:orders" => "logged"
        ]);
        $this->post("/users/login", UsersController::class . "@login");
    }
}
