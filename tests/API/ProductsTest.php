<?php

namespace Tests\API;

use Laravel\Lumen\Testing\DatabaseTransactions;
use Mathrix\Lumen\Zero\Testing\Traits\DebugTrait;
use Mathrix\Lumen\Zero\Testing\Traits\RESTAutoTestTrait;
use Mathrix\Lumen\Zero\Testing\Traits\RESTTrait;
use Tests\TestCase;

class ProductsTest extends APIStatelessTestCase
{
    use RESTAutoTestTrait;

    protected $testKeys = [
        "std:index",
        "std:post",
        "std:get",
        "std:patch",
        "rel:get:stocks"
    ];

    public function testEnabled()
    {
        $this->json("get", "/products/enabled");
        $this->assertResponseOk();
    }
}
