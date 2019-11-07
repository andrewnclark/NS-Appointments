<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class AuthTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @test
     */
    public function routes_are_authenticated()
    {
        $user = factory(User::class)->create(['api_token' => 'valid']);
    }
}
