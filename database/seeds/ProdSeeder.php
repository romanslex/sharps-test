<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Models\User;

class ProdSeeder extends Seeder
{
    public function run()
    {
        $this->createAdmin();
        $this->createUsers();
        $this->createTransactions();
    }

    private function createAdmin()
    {
        return factory(User::class)->create([
            'name' => 'admin',
            'email' => 'admin@mail.ru',
            'password' => Hash::make('secret')
        ]);
    }

    private function createUsers()
    {
        return factory(User::class, 2)->create(['balance' => 500]);
    }

    private function createTransactions()
    {
        User::find(2)
            ->outboundTransactions()
            ->create([
                'recipient_id' => 3,
                'amount' => 130,
                'recipient_balance' => 630,
                'payer_balance' => 370,
                'performed_at' => now()->subDay(3)
            ]);

        User::find(2)
            ->outboundTransactions()
            ->create([
                'recipient_id' => 3,
                'amount' => 70,
                'recipient_balance' => 700,
                'payer_balance' => 300,
                'performed_at' => now()->subDay(2)
            ]);

        User::find(3)
            ->outboundTransactions()
            ->create([
                'recipient_id' => 2,
                'amount' => 200,
                'recipient_balance' => 500,
                'payer_balance' => 500,
                'performed_at' => now()->subDay(1)
            ]);

    }
}
