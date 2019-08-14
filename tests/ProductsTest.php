<?php

namespace Tests;

use Laravel\Lumen\Testing\DatabaseTransactions;
use Mathrix\Lumen\Zero\Testing\Traits\DebugTrait;

class ProductsTest extends TestCase
{
    use DatabaseTransactions, DebugTrait;

    public function testIndex()
    {
        $this->json("get", "/products");

        $this->assertResponseOk();
    }
}
