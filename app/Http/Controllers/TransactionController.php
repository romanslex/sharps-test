<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Models\User;
use mysql_xdevapi\Exception;

class TransactionController extends Controller
{
    public function create(Request $request)
    {
        $user = auth()->user()->firstOrFail();

        $request->validate([
            'recipient' => 'required|exists:users,id',
            'amount' => 'required|numeric|lte:' . $user->balance
        ]);

        $recipient = User::findOrFail($request->get('recipient'));
        $amount = $request->get('amount');

        \DB::transaction(function() use ($user, $recipient, $amount) {
            $user->balance -= $amount;
            $recipient->balance += $amount;
            $user->save();
            $user->outboundTransactions()->create([
                'recipient_id' => $recipient->id,
                'amount' => $amount,
                'payer_balance' => $user->balance,
                'recipient_balance' => $recipient->balance,
            ]);
            $recipient->save();
        });
    }
}
