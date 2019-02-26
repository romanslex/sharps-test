<?php

namespace Tests\Feature\Auth;

use Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends TestCase
{
    /** @test */
    public function redirect_guest_to_login()
    {
        // act
        $response = $this->get(route('home'));

        // assert
        $response->assertRedirect(route('login'));
    }
}
