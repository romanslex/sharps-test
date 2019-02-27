<?php

namespace Tests\Feature\Models;

use App\Exceptions\NotEnoughMoneyException;
use Models\Transaction;
use Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TransactionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function createRemittance_must_throw_NotEnoughMoneyException()
    {
        // assert
        $this->expectException(NotEnoughMoneyException::class);

        // arrange
        $payer = factory(User::class)->create(['balance' => 200]);
        $recipient = factory(User::class)->create(['balance' => 200]);

        // act
        Transaction::createRemittance($payer, $recipient, 400);
    }
}
