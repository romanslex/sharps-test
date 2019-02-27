<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Models\Transaction;
use Models\User;

class DevSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $mainUser = $this->createMainUser();
        $users = factory(User::class, 9)->create();
        $users[] = $mainUser;

        foreach($users as $payer)
        {
            foreach($users as $recipient){
                if($payer->id === $recipient->id)
                    continue;

                factory(Transaction::class)->create([
                    'payer_id' => $payer->id,
                    'recipient_id' => $recipient->id
                ]);
            }
        }
    }

    public function createMainUser(){
        return factory(User::class)->create([
            'name' => 'Roman',
            'email' => 'example@mail.ru',
            'password' => Hash::make('secret')
        ]);
    }
}
