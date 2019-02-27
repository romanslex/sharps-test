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

    /** @test */
    public function createRemittance_must_succeed()
    {
        // arrange
        $payer = factory(User::class)->create(['name' => 'payer', 'balance' => 200]);
        $recipient = factory(User::class)->create(['name' => 'recipient', 'balance' => 200]);

        // act
        Transaction::createRemittance($payer, $recipient, 100);

        // assert
        $this->assertDatabaseHas('users', ['name' => 'payer', 'balance' => 100]);
        $this->assertDatabaseHas('users', ['name' => 'recipient', 'balance' => 300]);
        $this->assertDatabaseHas('transactions', ['id' => 1]);
    }
}
