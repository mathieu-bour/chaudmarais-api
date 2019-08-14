<?php

namespace Tests;

use Laravel\Lumen\Application;
use Laravel\Lumen\Testing\TestCase as LaravelTestCase;

abstract class TestCase extends LaravelTestCase
{
    /**
     * Creates the application.
     *
     * @return Application
     */
    public function createApplication()
    {
        return require __DIR__ . '/../bootstrap/app.php';
    }
}
