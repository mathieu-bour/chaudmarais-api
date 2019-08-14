<?php

namespace Tests\API;

use Laravel\Lumen\Testing\DatabaseTransactions;
use Mathrix\Lumen\Zero\Testing\Traits\DebugTrait;
use Mathrix\Lumen\Zero\Testing\Traits\RESTTrait;
use Tests\TestCase;

class UsersTest extends TestCase
{
    use DatabaseTransactions, RESTTrait, DebugTrait;

    public function testPost(): void
    {
        $this->json("post", "/users", [
            "first_name" => "Mathieu",
            "last_name" => "Bour",
            "email" => "mathieu.tin.bour@gmail.com",
            "password" => "password"
        ]);

        $this->assertResponseOk();
    }
}
