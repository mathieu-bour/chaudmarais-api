<?php

namespace Tests\API;

use App\Models\Address;
use Mathrix\Lumen\JWT\Auth\JWT;
use Mathrix\Lumen\Zero\Testing\Traits\DebugTrait;

class CartTest extends APIStatelessTestCase
{
    use DebugTrait;

    private function getCartPayload() {
        return [
            ["stock_id" => 1, "quantity" => 2],
            ["stock_id" => 6, "quantity" => 1]
        ];
    }

    public function testValidate(): void
    {
        $this->json("post", "/cart/check", [
            "cart" => $this->getCartPayload()
        ]);

        $this->debug();
    }

    public function testSubmit(): void
    {
        /** @var Address $address */
        $address = Address::query()->findOrFail(1);
        $user = $address->user;

        JWT::actingAs($user);

        $this->json("post", "/cart/submit", [
            "cart" => $this->getCartPayload(),
            "address_id" => $address->id
        ]);

        $this->debug();
    }
}
