<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class AuthTest extends TestCase
{
    use DatabaseMigrations;
    use DatabaseTransactions;
    
    /**
     * A basic test example.
     *
     * @test
     */
    public function index_returns_200_if_authenticated()
    {
        $user = factory(App\User::class)->create(['api_token' => 'valid']);

        $reponse = $this->actingAs($user)->call('GET', '/');

        $this->assertEquals(200, $reponse->status());
    }

    /**
     * @test
     */
    public function index_returns_401_if_not_authenticated()
    {
        $user = factory(App\User::class)->create(['api_token' => 'valid']);

        $reponse = $this->call('GET', '/');

        $this->assertEquals(401, $reponse->status());
    }
}
