<?php

namespace Tests\API;

use Laravel\Lumen\Testing\DatabaseTransactions;

class APIStatelessTestCase extends APIStatefulTestCase
{
    use DatabaseTransactions;
}
