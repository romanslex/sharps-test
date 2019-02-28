<?php

namespace Tests\Feature\Auth;

use Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function redirect_guest_to_login()
    {
        // act
        $response = $this->get(route('home'));

        // assert
        $response->assertRedirect(route('login'));
    }

    /** @test */
    public function user_can_visit_home()
    {
        // arrange
        $user = factory(User::class)->create(['id' => 2]);

        // act
        $response = $this
            ->actingAs($user)
            ->get(route('home'));

        // assert
        $response->assertOk();
    }
}
