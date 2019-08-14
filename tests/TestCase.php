<?php

namespace Tests;

use Faker\Generator;
use Laravel\Lumen\Application;
use Mathrix\Lumen\Zero\Testing\BaseTestCase as ZeroTestCase;

abstract class TestCase extends ZeroTestCase
{
    /** @var Generator */
    public $faker;


    /**
     * Setup the test environment.
     * Inject a new Faker instance.
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->faker = app()->make(Generator::class);
    }


    /**
     * Destroy database connection after each test to avoid the Too Many Connections error.
     */
    public function tearDown(): void
    {
        $this->beforeApplicationDestroyed(function () {
            app()->make("db")->disconnect();
        });

        parent::tearDown();
    }

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
