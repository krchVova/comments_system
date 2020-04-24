<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function setUp(): void
    {
        parent::setUp();

        $this->artisan('migrate');
        $this->artisan('db:seed');

    }

    /**
     * @throws \Throwable
     */
    public function tearDown(): void
    {
        $this->artisan('migrate:refresh');
        $this->artisan('db:seed');

        parent::tearDown();
    }
}
